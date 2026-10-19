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


import api from "@/services/api.js";

const CategoryPage = () => {
  const _initForm = {
    id: null,
    name: "",
  };

  const [showModal, setShowModal] = useState(false);
  const [categories, setCategories] = useState([]);
  const [formData, setFormData] = useState(_initForm);
  const [isEdit, setIsEdit] = useState(false);

  const fetchCategories = async () => {
    try {
      const response = await api.get("/category");
      setCategories(response.data);
      console.log(response);
    } catch (error) {
      console.log(error.message);
    }
  };
  useEffect(() => {
    console.log("render ini");
    fetchCategories();
  }, []); //[] dependency biar gak render terus

  const handleOpenModal = () => {
    setShowModal(true);
    setFormData(_initForm);
    setIsEdit(false);
  };

  const handleEditModal = (category) => {
    console.log(category);
    setShowModal(true);
    setIsEdit(true);
    setFormData({
      ...category,
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
      };

      if (isEdit) {
        await api.put(`/category/${formData.id}`, payload);
      } else {
        await api.post("/category", payload);
      }
      setFormData(_initForm);
    } catch (error) {
      const errMsg = error.message;
      console.log(errMsg);
    } finally {
      fetchCategories();
      setShowModal(false);
    }
  };

  // DELETE category

  const handleDelete = async (id) => {
    const confirmation = window.confirm(
      "Are you sure want to delete this data?",
    );
    if (confirmation) {
      await api.delete(`/category/${id}`);
      fetchCategories();
    }
  };

  return (
    <>
      <Card className="shadow-sm border-border p-4 max-w-4xl ms-0 w-full">
        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-4">
          <div>
            <CardTitle className="text-xl font-bold">Categories</CardTitle>
          </div>
          <Button onClick={handleOpenModal}>Create new category</Button>
        </CardHeader>
        <CardContent className="p-0">
          <Table className="w-full text-left text-sm">
            <TableHeader className="border-y bg-muted/30 text-xs uppercase text-muted-foreground">
              <TableRow>
                <TableHead className="px-6 py-3 font-medium">#</TableHead>
                <TableHead className="px-6 py-3 font-medium">
                  Category
                </TableHead>
                <TableHead className="px-6 py-3 font-medium">Action</TableHead>
              </TableRow>
            </TableHeader>
            <TableBody className="divide-y divide-border">
              {categories.length > 0 ? (
                categories.map((category, index) => (
                  <TableRow
                    key={index}
                    className="hover:bg-muted/50 transition-colors"
                  >
                    <TableCell className="px-4 py-6 whitespace-nowrap">
                      {index + 1}
                    </TableCell>
                    <TableCell>{category.name}</TableCell>
                    <TableCell>{category.action}</TableCell>

                    <TableCell className="px-4 py-6 text-right whitespace-nowrap">
                      <Button
                        onClick={() => handleEditModal(category)}
                        variant="outline"
                        size="sm"
                        className="rounded-full me-2"
                      >
                        Edit
                      </Button>
                      <Button
                        onClick={() => handleDelete(category.id)}
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
                    Belum ada data category
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
        title={isEdit ? "Edit category" : "Create New category"}
        onSubmit={handleSubmit}
        submitLabel={isEdit ? "Save Change" : "Save"}
      >
        <div className="space-y-4">
          <div className="space-y-2">
            <Label>Category Name</Label>
            <Input
              id="name"
              name="name"
              value={formData.name}
              onChange={handleChange}
              required
              placeholder="Enter category name"
            ></Input>
          </div>
        </div>
      </AppModal>
    </>
  );
};

export default CategoryPage;
