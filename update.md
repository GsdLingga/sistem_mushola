# UPDATE

* Bersihin komponen views, controller, model atau resource (css, js, dll.) yang gak kepake biar gak bingung

* Untuk semua yang isi fitur delete, pake delete cascade, misal siswa A dihapus, di raport siswa A juga harus dihapus.

* Module Dashboard:
    - Guru : 1 kelas diisi 1 guru, 1 guru bisa mengisi banyak kelas, jadi pas user guru login, didashboard cuma tampil kelas dan siswa yang diajar, terus dibuatin chart _kelas_ (a, b, c dst.) designnya mirip seperti dashboard yg sekarang

    - Admin : dashboard diisi total dan chart seluruh _user_ (admin, guru, pengurus) dan seluruh _kelas_ (a, b, c dst.)

    - Pengurus : isi total dan chart seluruh _kelas_ (a, b, c dst.) aja

* Module User:
    - delete user masih belum bisa

* Module Siswa:
    - edit siswa masih error
    - tambahin menu atau crud Kelas, di kelasnya bisa milih guru, field yg lain disesuaikan
    - tambahin menu atau crud tahun ajaran, disesuaikan
    - create dan update nilai siswa belum bisa
    - tabel daftar nilai siswa, nama mata pelajaran dijadiin table header, biar 1 siswa jadi 1 row aja
    - nilai spritual, sosial dan catatan dijadiin crud aja 
    - crud absensi tolong dicek lagi masih error
    - field create/edit absen : nama siswa, tanggal, status (tanggalnya ke set otomatis, tapi masih bisa diedit)

*  tolong di test CRUD permodul
