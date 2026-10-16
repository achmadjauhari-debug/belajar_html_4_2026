import Login from "./pages/Login";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import Dashboard from "./pages/Dashboard";
import MainLayout from "./pages/MainLayout";
import ListUser from "./pages/user/List";
// import Products from "./pages/Products/Products"
import ListProduct from "./pages/Products/Products";
import SignUp from "./pages/SignUp";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Navigate to="/login" replace />} />
        <Route path="/login" element={<Login />}></Route>
        <Route path="/signup" element={<SignUp />}></Route>
        
        <Route element={<MainLayout />}>
          <Route path="/dashboard" element={<Dashboard />}></Route>
          <Route path="/user" element={<ListUser />}></Route>
          <Route path="/products" element={<ListProduct />}></Route>
          
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
