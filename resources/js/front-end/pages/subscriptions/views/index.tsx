import React, { useEffect, FC, useState } from "react";
import { getAllSubscriptions, updateSubscriptionStatus } from "../../../services/subscriptions";
import { ISubscription } from "../../../types/subcription";
import MaterialTable from 'material-table'
import { dataModifier } from "../components/table";
import { useHistory } from "react-router-dom";

const Subscriptions: FC = () => {
  const history = useHistory();
  const [subscriptions, setSubscriptions] = useState<ReadonlyArray<ISubscription>>([]);

  const onEdit = (id: number) => {
    history.push({
      pathname: `/subscriptions/update/${id}`
    });
  };

  useEffect(() => {
    async function get() {
      const res = await getAllSubscriptions();
      setSubscriptions(res.data);
    }
    get();
  }, []);

  const handleUpdateStatus = async (id: number, status: string) => {

    const res = await updateSubscriptionStatus(id,)

  }


  return (
    <>
      <MaterialTable
        columns={[
          { title: 'Subscriber', field: 'subscriber' },
          { title: 'Creation date', field: 'created_at' },
          { title: 'Category', field: 'category' },
          { title: 'CPF', field: 'cpf' },
          { title: 'UF', field: 'uf' },
          { title: 'Status', field: 'status' },
          { title: 'Total', field: 'total' }
        ]}
        actions={[
          {
            icon: 'edit',
            tooltip: 'Update Status',
            onClick: (event, rowData: { id: number }) => onEdit(rowData.id)
          },
          {
            icon: 'edit',
            tooltip: 'Edit Subscription',
            onClick: (event, rowData: { id: number }) => onEdit(rowData.id)
          },
          {
            icon: 'delete',
            tooltip: 'Delete Subscription',
            onClick: (event, rowData: { id: number }) => confirm("You want to delete " + rowData.name)
          }]}
        editable={{
          onRowUpdate: (newData, oldData) =>         ,
          onRowDelete: oldData =>
            new Promise((resolve, reject) => {
              setTimeout(() => {
                const dataDelete = [...data];
                const index = oldData.tableData.id;
                dataDelete.splice(index, 1);
                setData([...dataDelete]);

                resolve()
              }, 1000)
            }),
        }}
        data={dataModifier(subscriptions)}
        title="Subscriptions"
      />
    </>
  );
};

export default Subscriptions;
