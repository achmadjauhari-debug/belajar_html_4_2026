// import { Card, Form, Button, Table, Modal } from "react-bootstrap";
import { useState } from "react";
import AppModal from "../../components/AppModal";

import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
  CardAction,
} from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Button } from "@/components/ui/button";



const dataUsers = [
  {
    id: 1,
    name: "Reza",
    email: "asdasd@asdasd.com",
    password: 1234567,
  },
  {
    id: 2,
    name: "Budi",
    email: "budi@asdasd.com",
    password: 1234567,
  },
  {
    id: 3,
    name: "Ani",
    email: "ani@asdasd.com",
    password: 1234567,
  },
];
const ListUser = () => {
  const [users, setUsers] = useState(dataUsers);
  const [showModal, setShowModal] = useState(false);
  const [isEdit, setIsEdit] = useState(false);

  const handleOpenModal = () => {
    setShowModal(true);
    // setFormData (_initForm);
    setIsEdit(false);
  };
  const handleEditModal = (user) => {
    setShowModal(true);
    setIsEdit(true);
    setFormData(user);
  };

  const handleCloseModal = () => {
    setShowModal(false);
  };

  // Posisinya sekarang di sini (sejajar dengan fungsi lain, di luar handleSubmit)
  const handleChange = (e) => {
    const { name, value } = e.target;

    setFormData({
      ...formData,
      [name]: value,
    });
  };

  // showModal State Awal False, begitu di Open jadi True, di close lagi jadi false
  //  const [formData, setFormData] = useState(_initForm) -> kalau mau pakai initForm
  const [formData, setFormData] = useState({
    id: "null",
    name: "",
    email: "",
    password: "",
    status: "Active",
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    // jika isEdit = true maka query update
    if (isEdit) {
      setUsers(
        users.map((user) => (user.id === formData.id ? formData : user)),
      );
    } else {
      const newUser = {
        ...formData,
        id: Date.now(),
      };

      // ...user di bungkus ke dalam newUser
      setUsers([...users, newUser]);
      // setFormData(_initForm);
    }
    setShowModal(false);
  };

  const handleDelete = (id) => {
    const confirmation = window.confirm("Are your sure?");
    //filter : users
    if (confirmation) {
    setUsers(users.filter((u) => u.id !== id)); //ketika u tidak sama dengan id jangan di hapus
  }
  };

  return (
    <>
      <Card className="shadow-sm border-border p-6">
        <CardContent className="p-0">
          <div className="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 className="mb-0 fw-bold">Data User</h4>
            </div>
            <Button variant="primary" onClick={handleOpenModal}>
              Create New User
            </Button>
          </div>
          <table className="w-full text-left text-sm">
            <thead className="border-y bg-muted/30 text-xs uppercase text-muted-foreground">
              <tr>
                <th className="px-6 py-3 font-medium">#</th>
                <th className="px-6 py-3 font-medium">Name</th>
                <th className="px-6 py-3 font-medium">Email</th>
                <th className="px-6 py-3 font-medium">Status</th>
                <th className="px-6 py-3 font-medium">Action</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-border">
              {users.map((user, index) => (
                <tr key={index} className="hover:bg-muted/50 transition-colors">
                  <td className="px-4 py-6 whitespace-nowrap">{index + 1}</td>
                  <td>{user.name}</td>
                  <td>{user.email}</td>
                  <td>Active</td>
                  <td className="pk-4 py-6 text-right whitespace-nowrap">
                    <Button
                      onClick={() => handleEditModal(user)}
                      variant="warning"
                      size="sm"
                      className="border-black me-2"
                    >
                      Edit
                    </Button>
                    <Button
                      onClick={() => handleDelete(user.id)}
                      variant="danger"
                      size="sm"
                      className="border-black me-2"
                    >
                      Delete
                    </Button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </CardContent>
      </Card>

      {/* <Modal show={showModal} onHide={handleCloseModal}>
        <Modal.Header closeButton>
          <Modal.Title>Create New User</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <Form>
            <Form.Group className="mb-3">
              <Form.Label>Name</Form.Label>
              <Form.Control
                type="text"
                name="name"
                placeholder="Enter Your Name"
                required
                value={formData.name}
                onChange={handleChange}
              ></Form.Control>
            </Form.Group>

            <Form.Group className="mb-3">
              <Form.Label>Email</Form.Label>
              <Form.Control
                type="email"
                name="email"
                placeholder="Enter Your Email"
                required
                value={formData.email}
                onChange={handleChange}
              ></Form.Control>
            </Form.Group>

            <Form.Group className="mb-3">
              <Form.Label>Password</Form.Label>
              <Form.Control
                type="password"
                name="password"
                placeholder="Enter Your Password"
                required
                value={formData.password}
                onChange={handleChange}
              ></Form.Control>
            </Form.Group>
          </Form>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleCloseModal}>
            Close
          </Button>
          <Button type="submit" variant="primary" onClick={handleSubmit}>
            Save Changes
          </Button>
        </Modal.Footer>
      </Modal> */}

      <AppModal
        show={showModal}
        onClose={handleCloseModal}
        title={isEdit ? "Edit User" : "Create New User"}
        onSubmit={handleSubmit}
        submitLabel={isEdit ? "Save Change" : "Save New User"}
      >

          {/* <Form.Group className="mb-3">
            <Form.Label>Name</Form.Label>
            <Form.Control
              type="text"
              name="name"
              placeholder="Enter Your Name"
              required
              value={formData.name}
              onChange={handleChange}
            ></Form.Control>
          </Form.Group>

          <Form.Group className="mb-3">
            <Form.Label>Email</Form.Label>
            <Form.Control
              type="email"
              name="email"
              placeholder="Enter Your Email"
              required
              value={formData.email}
              onChange={handleChange}
            ></Form.Control>
          </Form.Group>

          <Form.Group className="mb-3">
            <Form.Label>Password</Form.Label>
            <Form.Control
              type="password"
              name="password"
              placeholder="Enter Your Password"
              required
              value={formData.password}
              onChange={handleChange}
            ></Form.Control>
          </Form.Group> */}
   
      </AppModal>
    </>
  );
};

export default ListUser;
