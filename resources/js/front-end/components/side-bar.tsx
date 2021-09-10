import { Box } from "@material-ui/core";
import React, { FC } from "react";
import { Link, BrowserRouter as Router } from "react-router-dom";

const SideBar: FC = ({ children }) => {
    return (
        <Router>
            <Box display="flex" height="100vh">
                <Box
                    style={{
                        padding: "10px",
                        width: "12%",
                        background: "#f0f0f0",
                    }}
                >
                    <ul style={{ listStyleType: "none", padding: 0 }}>
                        <li>
                            <Link to="/">Home</Link>
                        </li>
                        <li>
                            <Link to="/users/create">Create Users</Link>
                        </li>
                        <li>
                            <Link to="/courses/create">Create Course</Link>
                        </li>
                        <li>
                            <Link to="/subscriptions">List Subscriptions</Link>
                        </li>
                        <li>
                            <Link to="/subscriptions/create">Create Subscription</Link>
                        </li>
                    </ul>
                </Box>
                <Box display="flex" flex={1} justifyContent="center">{children}</Box>
            </Box>
        </Router>
    );
};

export default SideBar;
