import { v4 } from "uuid";
import React, { useEffect, FC, useState } from "react";
import { getAllCourses } from "../../../services/courses";
import { Link, useRouteMatch } from "react-router-dom";
import { ICourse } from "../../../types/course";

const Courses: FC = () => {
  const [courses, setCourses] = useState<ReadonlyArray<ICourse>>();

  useEffect(() => {
    async function get() {
      const res = await getAllCourses();
      setCourses(res.data);
    }
    get();
  }, []);

  return (
    <>
      {courses?.map(({ name }) => (
        <p key={v4()}>{name}</p>
      ))}
    </>
  );
};

export default Courses;
