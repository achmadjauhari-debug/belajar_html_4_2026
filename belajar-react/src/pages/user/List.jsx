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

// const dataUsers = [
//   {
//     id: 1,
//     name: "Reza",
//     email: "ribrahim50@gmail.com",
//     password: 12345678,
//     status: "Active",
//     action: "",
//   },
//   {
//     id: 2,
//     name: "Budi",
//     email: "budi@gmail.com",
//     password: 12345678,
//     status: "Active",
//     action: "",
//   },
//   {
//     id: 3,
//     name: "ani",
//     email: "ani@gmail.com",
//     password: 12345678,
//     status: "Active",
//     action: "",
//   },
// ];
import api from "@/services/api.js";

const ListUser = () => {
  const _initForm = {
    id: null,
    name: "",
    email: "",
    password: "",
    is_Active: "1",
  };

  const [showModal, setShowModal] = useState(false);
  const [users, setUsers] = useState([]);
  const [formData, setFormData] = useState(_initForm);
  const [isEdit, setIsEdit] = useState(false);


  const fetchUser = async () => {
    try {
      const response = await api.get("/user");
      setUsers(response.data);
    } catch (error) {
      console.log(error.message);
    }
  };
  useEffect(() => {
    fetchUser();
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
      is_Active: user.is_Active ? "1" : "0"
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

      if (isEdit) {
        // update data
        await api.put(`/user/${formData.id}`, payload);

        // setUsers(
        //   users.map((user) => (user.id === formData.id ? formData : user)),
        // );
      } else {
        await api.post("/user", payload);

        // const newUser = {
        //   ...formData,
        //   id: Date.now(),
        // };

        // setUsers([...users, newUser]);
      }
      setFormData(_initForm);
    } catch (error) {
      const errMsg = error.message;
      console.log(errMsg);
    } finally {
      fetchUser();
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
      // setUsers(users.filter((u) => u.id !== id));
      await api.delete(`/user/${id}`);
      fetchUser();
    }
    // filter: users
  };

  return (
    <>
      <Card className="shadow-sm border-border p-4">
        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-4">
          <div>
            <CardTitle className="text-xl font-bold">Data User</CardTitle>
          </div>
          <Button variant="outline" onClick={handleOpenModal}>
            Create New User
          </Button>
        </CardHeader>
        <CardContent className="p-0">
          <Table className="w-full text-left text-sm">
            <TableHeader className="border-y bg-muted/30 text-xs uppercase text-muted-foreground">
              <TableRow>
                <TableHead className="px-6 py-3 font-medium">#</TableHead>
                <TableHead className="px-6 py-3 font-medium">Name</TableHead>
                <TableHead className="px-6 py-3 font-medium">Email</TableHead>
                <TableHead className="px-6 py-3 font-medium">Status</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody className="divide-y divide-border">
              {users.length > 0 ? (
                users.map((user, index) => (
                  <TableRow
                    key={index}
                    className="hover:bg-muted/50 transition-colors"
                  >
                    <TableCell className="px-4 py-6 whitespace-nowrap">
                      {index + 1}
                    </TableCell>
                    <TableCell>{user.name}</TableCell>
                    <TableCell>{user.email}</TableCell>

                    <TableCell>
                      <span
                        className={`border rounded-sm p-2 ${user.is_Active ? "bg-green-600" : "bg-red-600"} text-white`}
                      >
                        {user.is_Active ? "Active" : "InActive"}
                      </span>
                    </TableCell>

                    <TableCell className="px-4 py-6 text-right whitespace-nowrap">
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
                    console.log("radio clicked:", value)
                    setFormData((prev) => ({ ...prev, is_Active: value}))
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

export default ListUser;
