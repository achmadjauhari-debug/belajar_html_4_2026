import Login from "./pages/Login";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import Dashboard from "./pages/Dashboard";
import MainLayout from "./pages/MainLayout";
import ListUser from "./pages/user/List";
import CategoryPage from "./pages/category/listCategory"
import ProductPage from "./pages/products/listProduct";
import ListTransaction from "./pages/transaction/listTransaction"
import FormTransaction from "./pages/transaction/formTransaction";


function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Navigate to="/login" replace />} />
        <Route path="/login" element={<Login />}></Route>

        <Route element={<MainLayout />}>
          <Route path="/dashboard" element={<Dashboard />}></Route>
          <Route path="/user" element={<ListUser />}></Route>
          <Route path="/category" element={<CategoryPage />}></Route>
          <Route path="/transaction" element={<ListTransaction />}></Route>
          <Route path="/transaction/create" element={<FormTransaction />}></Route>
          <Route path="/product" element={<ProductPage />}></Route>
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;

