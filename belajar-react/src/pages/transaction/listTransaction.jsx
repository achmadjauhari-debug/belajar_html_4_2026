import { useNavigate } from "react-router-dom";
import { useState, useEffect } from "react";
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";

import { Button } from "@/components/ui/button";
import AppModal from "@/components/AppModal";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { RadioGroup, RadioGroupItem } from "@/components/ui/radio-group";

import api from "@/services/api.js";

const ListTransaction = () => {
  const navigate = useNavigate();
  const _initForm = {
    id: null,
    name: "",
    email: "",
    password: "",
    is_Active: "1",
  };

  const [showModal, setShowModal] = useState(false);
  const [transactions, setTransactions] = useState([]);
  const [formData, setFormData] = useState(_initForm);
  const [isEdit, setIsEdit] = useState(false);

  // GETALLUSER
  const fetchTransaction = async () => {
    try {
      const response = await api.get("/transaction");
      setTransactions(response.data);
    } catch (error) {
      console.log(error.message);
    }
  };
  useEffect(() => {
    fetchTransaction();
  }, []);

  const handleOpenModal = () => {
    setShowModal(true);
    setFormData(_initForm);
    setIsEdit(false);
  };

  const handleEditModal = (user) => {
    console.log(user);
    setShowModal(true);
    setIsEdit(true);
    setFormData({
      ...user,
      password: "",
      is_Active: user.is_Active ? "1" : "0",
    });
  };

  const handleCloseModal = () => {
    setShowModal(false);
  };

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  // HANDLE SUBMIT
  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const payload = {
        name: formData.name,
        email: formData.email,
        password: formData.password,
        is_Active: parseInt(formData.is_Active, 10),
      };

      // UPDATE
      if (isEdit) {
        // update data
        await api.put(`/user/${formData.id}`, payload);
      } else {
        await api.post("/user", payload);
      }
      setFormData(_initForm);
    } catch (error) {
      const errMsg = error.message;
      console.log(errMsg);
    } finally {
      fetchTransaction();
      setShowModal(false);
    }

    // jika edit data
  };

  // DELETE USER

  const handleDelete = async (id) => {
    const confirmation = window.confirm(
      "Are you sure want to delete this data?",
    );
    if (confirmation) {
      // setTransactions(transactions.filter((u) => u.id !== id));
      await api.delete(`/user/${id}`);
      fetchTransaction();
    }
    // filter: transactions
  };

  return (
    <>
      <Card className="max-w-5xl w-full shadow-sm border-border p-6 bg-white rounded-lg">
        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-4">
          <div>
            <CardTitle className="text-2xl font-bold">
              Transaction List
            </CardTitle>
          </div>
          <Button onClick={() => navigate("/transaction/create")}>
            New Transaction
          </Button>
        </CardHeader>

        <CardContent className="p-0">
          <Table className="w-full text-left text-sm">
            <TableHeader className="border-b bg-transparent text-xs font-bold uppercase text-slate-500 tracking-wider">
              <TableRow>
                <TableHead className="font-medium text-slate-800 text-center px-4 py-4">#</TableHead>
                <TableHead className="font-medium text-slate-800 text-center px-4 py-4">
                  Order Number
                </TableHead>
                <TableHead className="font-medium text-slate-800 text-center px-4 py-4">
                  Payment Method
                </TableHead>
                <TableHead className="font-medium text-slate-800 text-center px-4 py-4">
                  Products
                </TableHead>
                <TableHead className="font-medium text-slate-800 text-centerpx-4 py-4">
                  Action
                </TableHead>
              </TableRow>
            </TableHeader>
            <TableBody className="divide-y divide-border">
              {transactions.length > 0 ? (
                transactions.map((user, index) => (
                  <TableRow
                    key={index}
                    className="hover:bg-muted/50 transition-colors"
                  >
                    <TableCell className="px-4 py-6 whitespace-nowrap">
                      {index + 1}
                    </TableCell>
                    <TableCell>{user.order_number}</TableCell>
                    <TableCell>
                      {user.payment_method === 1 ? "GOPAY" : "CASH"}
                    </TableCell>
                    <TableCell>
                      <ul>
                        {user.items.map((item, idx) => (
                          <li key={`${item.id || idx}-${idx}`}>{item.name}</li>
                        ))}
                      </ul>
                    </TableCell>

                    <TableCell className="px-6 py-6 whitespace-nowrap text-center">
                      <div className="flex items-center justify-center gap-3">
                      <Button
                        onClick={() => handleEditModal(user)}
                        variant="outline"
                        size="sm"
                        className="rounded-full me-2"
                      >
                        Edit
                      </Button>
                      <Button
                        onClick={() => handleDelete(user.id)}
                        variant="destructive"
                        size="sm"
                        className="rounded-full me-2"
                      >
                        Delete
                      </Button>
                      </div>
                    </TableCell>
                  </TableRow>
                ))
              ) : (
                <TableRow>
                  <TableCell
                    colSpan={5}
                    className="text-center py-4 text-muted"
                  >
                    Belum ada data user
                  </TableCell>
                </TableRow>
              )}
            </TableBody>
          </Table>
        </CardContent>
      </Card>

      <AppModal
        show={showModal}
        onClose={handleCloseModal}
        title={isEdit ? "Edit User" : "Create New User"}
        onSubmit={handleSubmit}
        submitLabel={isEdit ? "Save Change" : "Save"}
      >
        <div className="space-y-4">
          <div className="space-y-2">
            <Label>Name</Label>
            <Input
              id="name"
              name="name"
              value={formData.name}
              onChange={handleChange}
              required
              placeholder="Enter your name"
            ></Input>
          </div>
          <div className="space-y-2">
            <Label>Email</Label>
            <Input
              type="email"
              id="email"
              name="email"
              value={formData.email}
              onChange={handleChange}
              required
              placeholder="Enter your email"
            ></Input>
          </div>
          <div className="space-y-2">
            <Label>Password</Label>
            <Input
              type="password"
              id="password"
              name="password"
              value={formData.password}
              onChange={handleChange}
              required={isEdit ? false : true}
              placeholder="Enter your password"
            ></Input>

            {/* acticvation */}
            {isEdit && (
              <div className="space-y-2">
                <Label>Set Active</Label>
                <RadioGroup
                  value={formData.is_Active}
                  onValueChange={(value) => {
                    console.log("radio clicked:", value);
                    setFormData((prev) => ({ ...prev, is_Active: value }));
                  }}
                >
                  <div className="flex items-center gap-3">
                    <RadioGroupItem value="1" id="status-active" />
                    <Label htmlFor="status-active">Active</Label>
                  </div>
                  <div className="flex items-center gap-3">
                    <RadioGroupItem value="0" id="status-inactive" />
                    <Label htmlFor="status-inactive">Not Active</Label>
                  </div>
                </RadioGroup>
              </div>
            )}
          </div>
        </div>
      </AppModal>
    </>
  );
};

export default ListTransaction;
