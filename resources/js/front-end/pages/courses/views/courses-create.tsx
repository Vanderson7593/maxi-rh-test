import React, { ChangeEvent, FC, FormEventHandler, useRef, useState } from "react";
import { Box, Button, FormControl, FormHelperText, InputLabel, MenuItem, Select, TextField, Typography } from "@material-ui/core";
import useAsyncState from "../../../hooks/use-async-state";
import { useForm } from 'react-hook-form';
import { createCourse } from "../../../services/courses";

import { useSnackbar } from 'react-simple-snackbar'
import { useParams } from "react-router";
import { ICourse } from "../../../types/course";
import { readSingleFileAsDataURL } from "../../../utils/file";

const CoursesCreate: FC = () => {
  const { errors, setErrors } = useAsyncState()
  const { handleSubmit, register, control, reset } = useForm<ICourse>();
  const [openSnackbar, _] = useSnackbar()
  const [file, setFile] = useState<File>();
  const formRef = useRef()

  const handleFormSubmit = handleSubmit<ICourse>(async courseFormData => {

    const res = await createCourse(courseFormData)

    if (res.status === 'error') {
      setErrors(res.message as unknown as Record<string, string[]>)
      return
    }

    if (res.status === 'success') {
      openSnackbar(res.message as string)
    }
  })

  const onChange = async (e: ChangeEvent<HTMLInputElement>) => {
    const file = await readSingleFileAsDataURL(e);
    setFile(file);
  }

  return (
    <Box width={400}>
      <Typography variant="h4">Create course</Typography>

      <form ref={formRef} onSubmit={handleFormSubmit}>
        <Box display="flex" flexDirection="column" style={{ gap: 20 }}>
          <TextField
            {...register("name")}
            error={!!errors?.name}
            label="Name"
            name="name"
            type="text"
            variant="filled"
            helperText={errors?.name}
          />

          <TextField
            {...register("description")}
            error={!!errors?.description}
            type="text"
            label="Description"
            name="description"
            variant="filled"
            helperText={errors?.description}
          />

          <TextField
            {...register("value")}
            error={!!errors?.value}
            type="text"
            label="Value"
            name="value"
            variant="filled"
            helperText={errors?.value}
          />

          <TextField
            {...register("sub_start_date")}
            error={!!errors?.sub_start_date}
            type="date"
            label="Subscription start date"
            InputLabelProps={{
              shrink: true,
            }}
            name="sub_start_date"
            variant="filled"
            helperText={errors?.sub_start_date}
          />

          <TextField
            {...register("sub_end_date")}
            error={!!errors?.sub_end_date}
            type="date"
            label="Subscription end date"
            name="sub_end_date"
            variant="filled"
            InputLabelProps={{
              shrink: true,
            }}
            helperText={errors?.sub_end_date}
          />

          <TextField
            {...register("max_sub")}
            error={!!errors?.max_sub}
            type="text"
            label="Max subscription"
            name="max_sub"
            variant="filled"
            helperText={errors?.max_sub}
          />

          <input
            type="file"
            onChange={onChange}
          />

          <Button variant="contained" color="primary" type="submit">Submit form</Button>
        </Box>
      </form>
    </Box>
  );
};

export default CoursesCreate;
