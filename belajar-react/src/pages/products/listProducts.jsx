import { useState, useEffect } from "react";
import {
  Card,
  CardContent,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select";

import { Button } from "@/components/ui/button";
import AppModal from "@/components/AppModal";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";

import api from "@/services/api.js";

const ProductPage = () => {
  const _initForm = {
    id: null,
    category_id: "",
    name: "",
    price: "",
    stock: "",
    description: "",
    is_active: 1,
  };

  const [showModal, setShowModal] = useState(false);
  const [products, setProducts] = useState([]); // Standardized state casing
  const [categories, setCategories] = useState([]);
  const [formData, setFormData] = useState(_initForm);
  const [isEdit, setIsEdit] = useState(false);

  // Fetch Products
  const fetchProducts = async () => {
    try {
      const response = await api.get("/product"); // Ensure backend matches this route
      setProducts(response.data);
    } catch (error) {
      console.log(error.message);
    }
  };

  // Fetch Categories
  const fetchCategories = async () => {
    try {
      const response = await api.get("/category");
      setCategories(response.data);
    } catch (error) {
      console.log(error.message);
    }
  };

  useEffect(() => {
    fetchProducts();
    fetchCategories();
  }, []);

  const handleOpenModal = () => {
    setShowModal(true);
    setFormData(_initForm);
    setIsEdit(false);
  };

  const handleEditModal = (row) => {
    setShowModal(true);
    setIsEdit(true);
    setFormData({
      id: row.id,
      category_id: row.category_id || "",
      name: row.name || "",
      price: row.price || "",
      stock: row.stock || "",
      description: row.description || "",
      is_active: row.is_active ? 1 : 0,
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

  // Handle Form Submission
  const handleSubmit = async (e) => {
    e.preventDefault();

    try {
      const payload = {
        name: formData.name,
        category_id: formData.category_id,
        price: parseFloat(formData.price),
        description: formData.description,
        stock: parseInt(formData.stock, 10),
        is_active: formData.is_active,
      };

      if (isEdit) {
        await api.put(`/product/${formData.id}`, payload);
      } else {
        await api.post("/product", payload);
      }
      setFormData(_initForm);
      fetchProducts();

    } catch (error) {
      console.log(error.message);
    } finally {
      setShowModal(false);
    }
  };

  // Delete Product
  const handleDelete = async (id) => {
    const confirmation = window.confirm("Are you sure want to delete this data?");
    if (confirmation) {
      try {
        await api.delete(`/product/${id}`); // Corrected endpoint endpoint path
        fetchProducts(); // Replaces the broken fetchTransaction() call
      } catch (error) {
        console.log(error.message);
      }
    }
  };

  return (
    <>
      <Card className="shadow-sm border-border p-4">
        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-4">
          <div>
            <CardTitle className="text-xl font-bold">Product List</CardTitle>
          </div>
          <Button variant="outline" onClick={handleOpenModal}>
            Create New Product
          </Button>
        </CardHeader>
        <CardContent className="p-0">
          <Table className="w-full text-left text-sm">
            <TableHeader className="border-y bg-muted/30 text-xs uppercase text-muted-foreground">
              <TableRow>
                <TableHead className="px-6 py-3 font-medium">#</TableHead>
                <TableHead className="px-6 py-3 font-medium">Name</TableHead>
                <TableHead className="px-6 py-3 font-medium">Category</TableHead>
                <TableHead className="px-6 py-3 font-medium">Price</TableHead>
                <TableHead className="px-6 py-3 font-medium">Stock</TableHead>
                <TableHead className="px-6 py-3 font-medium">Status</TableHead>
                <TableHead className="px-6 py-3 font-medium">Action</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody className="divide-y divide-border">
              {products.length > 0 ? (
                products.map((row, index) => (
                  <TableRow key={row.id || index} className="hover:bg-muted/50 transition-colors">
                    <TableCell className="px-4 py-6 whitespace-nowrap">{index + 1}</TableCell>
                    <TableCell>{row.name}</TableCell>
                    <TableCell>{row.category_name}</TableCell>
                    <TableCell>{row.price}</TableCell>
                    <TableCell>{row.stock}</TableCell>
                    <TableCell>{row.is_active ? "Active" : "Inactive"}</TableCell>
                    <TableCell className="px-4 py-6 text-right whitespace-nowrap">
                      <Button
                        onClick={() => handleEditModal(row)}
                        variant="outline"
                        size="sm"
                        className="rounded-full me-2"
                      >
                        Edit
                      </Button>
                      <Button
                        onClick={() => handleDelete(row.id)}
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
                  <TableCell colSpan={7} className="text-center py-4 text-muted">
                    Belum ada data produk
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
        title={isEdit ? "Edit Product" : "Create New Product"}
        onSubmit={handleSubmit}
        submitLabel={isEdit ? "Save Changes" : "Save"}
      >
        <div className="space-y-4">
          <div className="space-y-2">
            <Label>Category</Label>
            <Select
              value={formData.category_id}
              onValueChange={(val) => setFormData({ ...formData, category_id: val })} // Fixed typo here
              required
            >
              <SelectTrigger className="w-full">
                <SelectValue placeholder="Select one.." />
              </SelectTrigger>
              <SelectContent>
                {categories.map((category) => (
                  <SelectItem key={category.id} value={category.id.toString()}>
                    {category.name}
                  </SelectItem>
                ))}
              </SelectContent>
            </Select>
          </div>
          <div className="space-y-2">
            <Label>Name</Label>
            <Input
              id="name"
              name="name"
              value={formData.name}
              onChange={handleChange}
              required
              placeholder="Enter product name"
            />
          </div>
          <div className="space-y-2">
            <Label>Price</Label>
            <Input
              type="number"
              id="price"
              name="price"
              value={formData.price}
              onChange={handleChange}
              required
              placeholder="Enter product price"
            />
          </div>
          <div className="space-y-2">
            <Label>Stock</Label>
            <Input
              type="number"
              id="stock"
              name="stock"
              value={formData.stock}
              onChange={handleChange}
              required={!isEdit}
              placeholder="Enter product stock"
            />
          </div>
          <div className="space-y-2">
            <Label>Description</Label>
            <Input
              id="description"
              name="description"
              value={formData.description}
              onChange={handleChange}
              placeholder="Enter product description"
            />
          </div>
        </div>
      </AppModal>
    </>
  );
};

export default ProductPage;
