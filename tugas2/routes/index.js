var express = require("express");
var router = express.Router();
var fs = require("fs");
var path = require("path");

const dataPath = path.join(__dirname, "../data.json");

function readData() {
  try {
    const data = fs.readFileSync(dataPath, "utf8");
    return JSON.parse(data);
  } catch (err) {
    return { laporans: [] };
  }
}


function writeData(data) {
  fs.writeFileSync(dataPath, JSON.stringify(data, null, 2), "utf8");
}


function generateId(items) {
  if (items.length === 0) return 1;
  return Math.max(...items.map((item) => item.id)) + 1;
}

router.get("/", function (req, res, next) {
  res.sendFile(path.join(__dirname, "../public/index.html"));
});


router.get("/api/laporan", function (req, res, next) {
  const data = readData();
  // console.log(data);
  res.json({ success: true, data: data.laporans });
});


router.get("/api/laporan/:id", function (req, res, next) {
  const data = readData();
  const laporan = data.laporans.find((l) => l.id == req.params.id);

  if (!laporan) {
    return res
      .status(404)
      .json({ success: false, message: "Laporan tidak ditemukan" });
  }

  res.json({ success: true, data: laporan });
});


router.post("/api/laporan", function (req, res, next) {
  const data = readData();
  const { nama, email, pekerjaan, isi_laporan } = req.body;

  if (!nama || !email || !pekerjaan || !isi_laporan) {
    return res
      .status(400)
      .json({ success: false, message: "Semua field harus diisi" });
  }

  const laporan = {
    id: generateId(data.laporans),
    nama,
    email,
    pekerjaan,
    isi_laporan,
  };

  data.laporans.push(laporan);
  writeData(data);

  res.json({
    success: true,
    message: "Laporan berhasil ditambahkan",
    data: laporan,
  });
});


router.put("/api/laporan/:id", function (req, res, next) {
  const data = readData();
  const { nama, email, pekerjaan, isi_laporan } = req.body;

  if (!nama || !email || !pekerjaan || !isi_laporan) {
    return res
      .status(400)
      .json({ success: false, message: "Semua field harus diisi" });
  }

  const index = data.laporans.findIndex((l) => l.id == req.params.id);

  if (index === -1) {
    return res
      .status(404)
      .json({ success: false, message: "Laporan tidak ditemukan" });
  }

  data.laporans[index] = {
    id: parseInt(req.params.id),
    nama,
    email,
    pekerjaan,
    isi_laporan,
  };

  writeData(data);
  res.json({
    success: true,
    message: "Laporan berhasil diupdate",
    data: data.laporans[index],
  });
});


router.delete("/api/laporan/:id", function (req, res, next) {
  const data = readData();
  const index = data.laporans.findIndex((l) => l.id == req.params.id);

  if (index === -1) {
    return res
      .status(404)
      .json({ success: false, message: "Data tidak ditemukan" });
  }

  const deletedLaporan = data.laporans.splice(index, 1)[0];
  writeData(data);

  res.json({
    success: true,
    message: "Laporan berhasil dihapus",
    data: deletedLaporan,
  });
});

module.exports = router;
