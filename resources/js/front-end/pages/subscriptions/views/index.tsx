import React, { useEffect, FC, useState } from "react";
import { deleteSubscription, getAllSubscriptions, updateSubscriptionStatus } from "../../../services/subscriptions";
import { ISubscription } from "../../../types/subcription";
import MaterialTable from 'material-table'
import { dataModifier } from "../components/table/utils";
import { useHistory } from "react-router-dom";
import useAsyncState from "../../../hooks/use-async-state";
import { useSnackbar } from 'react-simple-snackbar'
import { v4 as uuid } from "uuid";
import SubscriptionsTable from "../components/table";

const Subscriptions: FC = () => {
  const history = useHistory();
  const [subscriptions, setSubscriptions] = useState<ReadonlyArray<ISubscription>>([]);
  const [openSnackbar, closeSnackbar] = useSnackbar()
  const [refresher, setRefresher] = useState<string>('');

  return (
    <>
      <SubscriptionsTable />
    </>
  );
};

export default Subscriptions;
