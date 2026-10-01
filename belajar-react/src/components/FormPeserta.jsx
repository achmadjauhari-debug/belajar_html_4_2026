import { useState,useEffect } from "react";

const FormPeserta = ({ onSimpan, onCancel,pesertaEdit }) => {
  const [nama, setNama] = useState("");
  const [jurusan, setJurusan] = useState("");
// useEffect : hasil request dari server menghasilkan sebuah data, di render cuma 1x
// useEffect(() => {

    useEffect(() => {
        if (pesertaEdit) {
            //edit data
            setNama(pesertaEdit.nama);
            setJurusan(pesertaEdit.jurusan);
        } else {
            //tambah data
            setNama("");
            setJurusan("");
        }
    },[pesertaEdit]);

  const handleSimpan = (e) => {
    e.preventDefault();
    // mencegah permintaan ke server
    // alert("DUAR");
    //jika dia edit

    //jika dia tambah
    onSimpan({
      id: pesertaEdit ? pesertaEdit.id : Date.now(),
      nama,
      jurusan,
    });
    setNama("");// mengosongkan input setelah disimpan
    setJurusan("");
  };

  return (
    <form
      onSubmit={handleSimpan}
      method="post"
      style={{
        backgroundColor: "#f5f5f5",
        padding: "16px",
        borderRadius: "8px",
        marginBottom: "20px",
      }}
    >
      Tambah Peserta : {nama} - {jurusan}
      <div
        style={{
          display: "flex",
          gap: "8px",
          flexwrap: "wrap",
        }}
      >
        <input
          type="text"
          style={{
            padding: "8px",
            borderRadius: "4px",
            border: "1px solid #070707",
          }}
          placeholder="Nama Peserta"
          value={nama} //ketika ada perubahan pada input, maka nilai state nama akan diperbarui dengan nilai baru dari input tersebut. Ini memungkinkan kita untuk menyimpan dan mengelola data yang dimasukkan oleh pengguna dalam komponen React.
          onChange={(e) => setNama(e.target.value)}
        />
        <input
          type="text"
          style={{
            padding: "8px",
            borderRadius: "4px",
            border: "1px solid #0c0c0c",
          }}
          placeholder="Jurusan"
          value={jurusan}
          onChange={(e) => setJurusan(e.target.value)}
        />
        <button
          type="submit"
          style={{
            background: "#4CAF50",
            color: "white",
            border: "none",
            borderRadius: "4px",
            cursor: "pointer",
            padding: "8px 16px",
          }}
        >
          Simpan
        </button>
      </div>
    </form>
  );
};

export default FormPeserta;
