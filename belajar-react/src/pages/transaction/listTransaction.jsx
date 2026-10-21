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

  // GET ALL TRANSACTION
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

  // DELETE TRANSACTION

  const handleDelete = async (id) => {
    // Konfirmasi sebelum menghapus (opsional tapi disarankan)
    if (!window.confirm("Apakah Anda yakin ingin menghapus data ini?")) return;

    try {
      // Menembak API delete berdasarkan ID
      await api.delete(`/transaction/${id}`);

      // Refresh data setelah berhasil dihapus
      fetchTransaction();

      alert("Data berhasil dihapus");
    } catch (error) {
      console.error("Gagal menghapus data:", error.message);
      alert("Somwthing wrong during remove data");
    }
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
                <TableHead className="font-medium text-slate-800 text-center px-4 py-4">
                  #
                </TableHead>
                <TableHead className="font-medium text-slate-800 text-left px-4 py-4">
                  Order Number
                </TableHead>
                <TableHead className="font-medium text-slate-800 text-left px-4 py-4">
                  Payment Method
                </TableHead>
                <TableHead className="font-medium text-slate-800 text-left px-4 py-4">
                  Products
                </TableHead>
                <TableHead className="font-medium text-slate-800 text-center px-4 py-4">
                  Total Transaction
                </TableHead>
                <TableHead className="font-medium text-slate-800 text-center px-4 py-4">
                  Action
                </TableHead>
              </TableRow>
            </TableHeader>
            <TableBody className="divide-y divide-border">
              {transactions.length > 0 ? (
                transactions.map((transaction, index) => (
                  <TableRow
                    key={index}
                    className="hover:bg-muted/50 transition-colors"
                  >
                    {/* 1. Counter */}
                    <TableCell className="px-4 py-6 whitespace-nowrap">
                      {index + 1}
                    </TableCell>
                    {/* 2. Order Number */}
                    <TableCell>{transaction.order_number}</TableCell>
                    {/* 3. Payment Method */}
                    <TableCell>
                      {transaction.payment_method === 1 ? "GOPAY" : "CASH"}{" "}
                    </TableCell>
                    {/* 4. Products */}
                    <TableCell>
                      <ul>
                        {transaction.items.map((item, idx) => (
                          <li key={`${item.id || idx}-${idx}`}>{item.name}</li>
                        ))}
                      </ul>
                    </TableCell>
                    {/* 5. Total Transaction Value */}
                    <TableCell className="px-4 py-6 whitespace-nowrap text-center font-semibold">
                      {transaction.total !=null ? (
                      Number(transaction.total).toLocaleString("id-ID", {
                        style: "currency",
                        currency: "IDR",
                        maximumFractionDigits: 0,
                      })
                      ) : ( "Rp 0")}
                    </TableCell>
                    {/* 6. Delete button */}
                    <TableCell className="px-6 py-6 whitespace-nowrap text-center">
                      <div className="flex items-center justify-center gap-3">
                        <Button
                          onClick={() => handleDelete(transaction.id)}
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
                    colSpan={6}
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
    </>
  );
};

export default ListTransaction;
