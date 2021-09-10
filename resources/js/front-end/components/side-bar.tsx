import React, { FC } from "react";
import { Link, BrowserRouter as Router } from "react-router-dom";

const SideBar: FC = ({ children }) => {
    return (
        <Router>
            <div style={{ display: "flex" }}>
                <div
                    style={{
                        padding: "10px",
                        width: "20%",
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
                            <Link to="/courses">List Courses</Link>
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
                </div>
                <div style={{ flex: 1, padding: "10px" }}>{children}</div>
            </div>
        </Router>
    );
};

export default SideBar;
