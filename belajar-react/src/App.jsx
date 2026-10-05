import Login from "./pages/Login";
import { BrowserRouter, Routes, Route, Navigate } from "react-router-dom";
import Dashboard from "./pages/Dashboard";
import MainLayout from "./pages/MainLayout";
import ListUser from "./pages/user/List";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<Navigate to="/login" replace />} />
        <Route path="/login" element={<Login />}></Route>

        <Route element={<MainLayout />}>
          <Route path="/dashboard" element={<Dashboard />}></Route>
          <Route path="/user" element={<ListUser />}></Route>
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;

// import { useState } from "react";
// import heroImg from "./assets/hero.png";
// import reactLogo from "./assets/react.svg";
// import viteLogo from "./assets/vite.svg";
// import "./App.css";
// import { Peserta } from "./components/Peserta";
// import DataPeserta from "./components/DataPeserta";
// import FormPeserta from "./components/FormPeserta";

// function App() {
//   const [listPeserta, setListPeserta] = useState(Peserta);
//   const [editPeserta, setEditPeserta] = useState(null);

//   // const listPeserta = Peserta;
//   const handleSubmit = (dataPeserta) => {
//     if (editPeserta) {
//       //edit data
//       setListPeserta(
//         listPeserta.map((item) =>
//           item.id === dataPeserta.id ? dataPeserta : item,
//         ),
//         setEditPeserta(null), //biar kembali ke kondisi awal setelah edit selesai
//       );
//     } else {
//       //tambah data
//       setListPeserta([...listPeserta, dataPeserta]);
//     }
//   };

//   const handleHapus = (id) => {
//     setListPeserta(listPeserta.filter((item) => item.id !== id));
//     if (id === editPeserta.id) {
//       setEditPeserta(null);
//     }
//   };

//   return (
//     <>
//       <FormPeserta onSimpan={handleSubmit} pesertaEdit={editPeserta} />
//       {/* <FormPeserta /> */}
//       {/* map : ini looping juga dari forEach */}
//       {listPeserta.map((item) => (
//         <DataPeserta
//           key={item.id}
//           peserta={item}
//           onEdit={setEditPeserta}
//           onHapus={handleHapus}
//         />
//       ))}
//     </>
//   );
// }

// //   //desctructuring adalah fitur JavaScript yang memungkinkan kita untuk mengekstrak nilai dari array atau properti dari objek dan menyimpannya dalam variabel terpisah. Ini membuat kode lebih bersih dan lebih mudah dibaca, karena kita dapat langsung mengakses nilai yang kita butuhkan tanpa harus merujuk ke struktur data secara keseluruhan.

// //   // const siswa = {
// //   //   nama: 'Wawan',
// //   //   kelas: 'Web Programming',
// //   //   nilai: 90
// //   // }
// //   // const { nama, kelas, nilai } = siswa
// //   // console.log(nama, kelas, nilai)

// //   const [count, setCount] = useState(0) //kondisi awal state count adalah 0,

// //   // getter, setter : count, setcount
// //   // ngerubah data jadi dinamis dengan aksi.useState adalah hook yang disediakan oleh React untuk mengelola state dalam komponen fungsional. State adalah data yang dapat berubah seiring waktu dan mempengaruhi tampilan komponen. Dengan useState, kita dapat mendeklarasikan variabel state dan fungsi untuk memperbarui nilai state tersebut. Setiap kali state diperbarui, komponen akan dirender ulang untuk mencerminkan perubahan tersebut.

// //   // 1.function component dan class component (sudah di tinggalin karena terlalu sulit)
// //   // function component adalah komponen yang dibuat dengan menggunakan fungsi JavaScript. Mereka lebih sederhana dan lebih mudah dipahami, terutama untuk komponen yang tidak memerlukan state atau lifecycle methods. Function component dapat menggunakan React Hooks untuk mengelola state dan efek samping.
// //   // class component adalah komponen yang dibuat dengan menggunakan kelas JavaScript. Mereka lebih kompleks dan memiliki akses ke fitur-fitur seperti state dan lifecycle methods secara langsung. Class component digunakan ketika kita membutuhkan lebih banyak kontrol atas perilaku komponen.
// // function Peserta({nama, kelas, nilai}) {
// // return (
// //   <div style={{ textAlign: 'center' }}>
// //     <h3>{nama}</h3>
// //     <p>{kelas}</p>
// //     <p>{nilai}</p>
// //     </div>
// // )
// // }
// // //props adalah cara untuk mengirim data dari komponen induk ke komponen anak. Props memungkinkan kita untuk membuat komponen yang dapat digunakan kembali dengan memberikan nilai yang berbeda pada setiap penggunaan. Props bersifat read-only, artinya komponen anak tidak dapat mengubah nilai props yang diterimanya dari komponen induk. Membuat komponen jadi lebih fleksibel dan dinamis, karena kita dapat menyesuaikan perilaku dan tampilan komponen berdasarkan data yang diterima melalui props.

// // return (
// //   <>
// //   <Peserta nama="Wawan" kelas="Web Programming" nilai="90" />
// //   <Peserta nama="Budi" kelas="Tekom" nilai="90" />
// //   <Peserta nama="Ratna" kelas="TKJ" nilai="90" />
// //   <p>Total Data: {count}</p>
// //   <button onClick={() => setCount(count + 1)}>Tambah {count}</button>
// //   <button onClick={() => setCount(count - 1)}>Kurang {count}</button>
// //   </>
// // )

// export default App;
