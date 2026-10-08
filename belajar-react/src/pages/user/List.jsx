import { useState } from "react";
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

const dataUsers = [
  {
    id: 1,
    name: "Reza",
    email: "ribrahim50@gmail.com",
    password: 12345678,
    status: "Active",
    action: "",
  },
  {
    id: 2,
    name: "Budi",
    email: "budi@gmail.com",
    password: 12345678,
    status: "Active",
    action: "",
  },
  {
    id: 3,
    name: "ani",
    email: "ani@gmail.com",
    password: 12345678,
    status: "Active",
    action: "",
  },
];

const ListUser = () => {
  const _initForm = {
    id: null,
    name: "",
    email: "",
    password: "",
    status: "Active",
    action: "",
  };

  const [showModal, setShowModal] = useState(false);
  const [users, setUsers] = useState(dataUsers);
  const [formData, setFormData] = useState(_initForm);
  const [isEdit, setIsEdit] = useState(false);

  const handleOpenModal = () => {
    setShowModal(true);
    setFormData(_initForm);
    setIsEdit(false);
  };

  const handleEditModal = (user) => {
    console.log(user);
    setShowModal(true);
    setIsEdit(true);
    setFormData(user);
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

  const handleSubmit = (e) => {
    e.preventDefault();

    // jika edit data
    if (isEdit) {
      setUsers(
        users.map((user) => (user.id === formData.id ? formData : user)),
      );
    } else {
      const newUser = {
        ...formData,
        id: Date.now(),
      };

      setUsers([...users, newUser]);
      setFormData(_initForm);
    }
    setShowModal(false);
  };

  const handleDelete = (id) => {
    const confirmation = window.confirm(
      "Are you sure want to delete this data?",
    );
    if (confirmation) {
      setUsers(users.filter((u) => u.id !== id));
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
                <TableHead className="px-6 py-3 font-medium">Action</TableHead>
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
                    <TableCell>{user.status}</TableCell>
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
            <Label>Name</Label>
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
            <Label>Name</Label>
            <Input
              type="password"
              id="password"
              name="password"
              value={formData.password}
              onChange={handleChange}
              required
              placeholder="Enter your password"
            ></Input>
          </div>
        </div>
      </AppModal>
    </>
  );
};

export default ListUser;
