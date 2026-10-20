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
      <Card className="max-w-5xl w-full shadow-sm border-border p-6 bg-white rounded-lg">
        {/* Adjusted header layout to match side-by-side positioning */}
        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-6">
          <CardTitle className="text-2xl font-bold text-slate-900">Product List</CardTitle>
          <Button className="border-slate-300 font-medium" onClick={handleOpenModal}>
            Create New Product
          </Button>
        </CardHeader>
        
        <CardContent className="p-0">
          {/* Changed width to w-full to fill out the container */}
          <Table className="w-full text-left text-sm">
            <TableHeader className="border-b bg-transparent text-xs font-bold uppercase text-slate-500 tracking-wider">
              <TableRow className="hover:bg-transparent">
                <TableHead className="px-6 py-4 font-bold text-center w-16">#</TableHead>
                <TableHead className="px-6 py-4 font-bold">Name</TableHead>
                <TableHead className="px-6 py-4 font-bold">Category</TableHead>
                <TableHead className="px-6 py-4 font-bold">Price</TableHead>
                <TableHead className="px-6 py-4 font-bold">Stock</TableHead>
                <TableHead className="px-6 py-4 font-bold">Status</TableHead>
                <TableHead className="px-6 py-4 font-bold text-center">Action</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody className="divide-y divide-slate-100">
              {products.length > 0 ? (
                products.map((row, index) => (
                  <TableRow key={row.id || index} className="hover:bg-slate-50/50 transition-colors">
                    <TableCell className="px-6 py-6 text-center text-slate-600">{index + 1}</TableCell>
                    <TableCell className="px-6 py-6 font-medium text-slate-800">{row.name}</TableCell>
                    <TableCell className="px-6 py-6 text-slate-600">{row.category_name}</TableCell>
                    <TableCell className="px-6 py-6 text-slate-600">{row.price}</TableCell>
                    <TableCell className="px-6 py-6 text-slate-600">{row.stock}</TableCell>
                    <TableCell className="px-6 py-6 text-slate-600">{row.is_active ? "Active" : "Inactive"}</TableCell>
                    <TableCell className="px-6 py-6 whitespace-nowrap text-center">
                      <div className="flex items-center justify-center gap-3">
                        <Button
                          onClick={() => handleEditModal(row)}
                          variant="outline"
                          size="sm"
                          className="px-4 py-1 h-8 border-slate-300 font-medium text-slate-700 hover:bg-slate-100"
                        >
                          Edit
                        </Button>
                        <Button
                          onClick={() => handleDelete(row.id)}
                          variant="ghost"
                          size="sm"
                          className="px-4 py-1 h-8 bg-red-50 text-red-500 font-medium border border-transparent hover:bg-red-100 hover:text-red-600"
                        >
                          Delete
                        </Button>
                      </div>
                    </TableCell>
                  </TableRow>
                ))
              ) : (
                <TableRow>
                  <TableCell colSpan={7} className="text-center py-8 text-slate-400">
                    Belum ada data produk
                  </TableCell>
                </TableRow>
              )}
            </TableBody>
          </Table>
        </CardContent>
      </Card>

      {/* AppModal markup continues normally below... */}


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
