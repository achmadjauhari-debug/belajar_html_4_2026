import { Card, Form, Button, Table, Modal, InputGroup } from "react-bootstrap";
import { useState } from "react";
import AppModal from "../../components/AppModal";

const dataProduct = [
  {
    id: 1,
    name: "Americano",
    cat: "Coffee",
    price: 300000,
    status: "Active",
  },
  {
    id: 2,
    name: "Croissant",
    cat: "Snack",
    price: 20000,
    status: "Active",
  },
  {
    id: 3,
    name: "Fried Chicken",
    cat: "Meal",
    price: 50000,
    status: "Not Active",
  },
];

const listProduct = () => {
  const [products, setProducts] = useState(dataProduct);
  const [showModal, setShowModal] = useState(false);
  const [isEdit, setIsEdit] = useState(false);
  const [formData, setFormData] = useState({
    id: "null",
    name: "",
    cat: "",
    price: "",
    status: "",
  });

  const handleOpenModal = () => {
    setShowModal(true);
    setIsEdit(false);
  };
  const handleEditModal = (product) => {
    setShowModal(true);
    setIsEdit(true);
    setFormData(product);
  };

  const handleCloseModal = () => {
    setShowModal(false);
  };
  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };
  const handleSubmit = (e) => {
    e.preventDefault();
    if (isEdit) {
      setProducts(
        products.map((product) =>
          product.id === formData.id ? formData : product,
        ),
      );
    } else {
      const newProduct = {
        ...formData,
        id: Date.now(),
      };
      setProducts([...products, newProduct]);
    }
    setShowModal(false);
  };
  const handleDelete = (id) => {
    const confirmation = window.confirm("Are your sure?");
    if (confirmation) {
      setProducts(products.filter((u) => u.id !== id));
    }
  };

  return (
    <>
      <Card className="shadow-sm border-0">
        <Card.Body>
          <div className="d-flex justify-content-between align-items-center mb-3">
            <div>
              <h4 className="mb-0 fw-bold">Product List</h4>
            </div>
            <Button variant="primary" onClick={handleOpenModal}>
              Create New Product
            </Button>
          </div>
          <Table responsive hover bordered className="align-middle mb-0">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              {products.map((product, index) => (
                <tr key={index}>
                  <td>{index + 1}</td>
                  <td>{product.name}</td>
                  <td>{product.cat}</td>
                  <td>Rp.{Number(product.price).toLocaleString("id-ID")}</td>
                  <td>{product.status}</td>
                  <td>
                    <Button
                      onClick={() => handleEditModal(product)}
                      variant="warning"
                      size="sm"
                      className="border-black me-2"
                    >
                      Edit
                    </Button>
                    <Button
                      onClick={() => handleDelete(product.id)}
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
          </Table>
        </Card.Body>
      </Card>
      <AppModal
        show={showModal}
        onClose={handleCloseModal}
        title={isEdit ? "Edit Product" : "Create New Product"}
        onSubmit={handleSubmit}
        submitLabel={isEdit ? "Save Change" : "Save New Product"}
      >
        <Form.Group className="mb-3">
          <Form.Label>Product</Form.Label>
          <Form.Control
            type="text"
            name="name"
            placeholder="Enter Your Product"
            required
            value={formData.name}
            onChange={handleChange}
          ></Form.Control>
        </Form.Group>

        <Form.Group className="mb-3">
          <Form.Label>Category</Form.Label>
          <Form.Select
            type="text"
            name="cat"
            placeholder="Enter Category"
            required
            value={formData.cat}
            onChange={handleChange}
          >
            <option value="">Select Category</option>
            <option value="Coffee">Coffee</option>
            <option value="Snack">Snack</option>
            <option value="Meal">Meal</option>
          </Form.Select>
        </Form.Group>

        <Form.Group className="mb-3">
          <Form.Label>Price</Form.Label>
          <InputGroup>
            <InputGroup.Text>Rp</InputGroup.Text>
            <Form.Control
              type="number"
              name="price"
              placeholder="Enter Price"
              required
              value={formData.price}
              onChange={handleChange}
            ></Form.Control>
          </InputGroup>
        </Form.Group>

        <Form.Group className="mb-3">
          <Form.Label>Status</Form.Label>
          <Form.Select
            type="text"
            name="status"
            placeholder="Enter Product Status"
            required
            value={formData.status}
            onChange={handleChange}
          >
            <option value="">Select Status</option>
            <option value="Active">Active</option>
            <option value="Not Active">Not Active</option>
          </Form.Select>
        </Form.Group>
      </AppModal>
    </>
  );
};

export default listProduct;
