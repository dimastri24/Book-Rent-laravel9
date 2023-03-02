## REQUIREMENTS

-   ada 2 jenis user : admin, penyewa
-   buku bisa memiliki multiple kategori
-   1 judul buku bisa berjumlah lebih dari satu (dibedakan dengan kode buku)
-   list buku bisa dilihat tanpa harus login
-   bisa melakukan pencarian buku melalui judul atau kategori
-   untuk peminjaman buku, pengunjung harus membuat akun sebagai penyewa
-   pengunjung bisa register sebagai penyewa, tapi harus di approve oleh admin
-   admin bisa menambah data buku, kategori dan assign kategori buku
-   penyewa maksimal pinjam 3 buku
-   peminjaman maksimal 3 hari
-   admin bisa melihat list buku yang sedang dipinjam
-   admin bisa melihat penyewa yang terkena denda (3 hari belum kembalikan buku) lalu melihat detail peminjamannya
-   admin bisa melihat log peminjaman buku (kasih tangal wajib pengembalian buku & tanggal aktual buku dikembalikan)

## Tools

-   PHP - Laravel 9
-   Laravel plugin: eloquent-sluggable
-   CSS - Bootstrap 5, Bootstrap Icons
-   Javascript library: jQuery, Select2

## How to run the project

-   clone repo or unzip file then open with your text editor or IDE
-   install the package `composer install`
-   create .env file and fill out the necessary environment like for the database
-   may also change the timezone etc according to your place (optional)
-   run project `php artisan serve`
-   create database
-   do migration and seeder
    -   `php artisan migrate`
    -   `php artisan db:seed --class=RoleSeeder`
    -   `php artisan db:seed --class=CategorySeeder`
    -   insert manually some sata to the table if something happend cause of no reference or data.

## What I discover & adding or changing by myself

-   Design halaman jelas beberapa ada yg berbeda, mirip pun class bootstrap nya bisa beda apalagi pas test responsive nya.
-   Bisa nampilin error message ataupun custom visual lainnya saat validasi dgn `@error` sesuai input jadi gk nampilin semua error di satu tempat. Contoh di halaman register, di halaman lain yg butuh juga kupake.
-   Masalah penulisan routing masih agak misteri kadang butuh nambah slash didepannya. Untuk yang di web route gk butuh slash tapi ntah knp aku lebih suka kasih aja biar tau kalo itu route url begitu juga di viewnya, jika kedepannya bakal pake route naming jadi lebih bagus krn keliatan bedanya. Yang aneh itu di view nya malah, krn kyk contoh disini aku coba group prefix, hasilnya yg di view url nya harus lengkap disertakan prefix nya juga. Kalo yg pake form, url action harus dikasih slash dulu kalo gk url yg previous keikut juga. Ternyata semua kecuali get data (bkn kecuali get method) kyk kalo add edit atau delete (bkn post, put, patch, delete) krn pas kita delete pake get juga butuh slash. Ok untuk yg di view, url link nya akan selalu langsung kasih slash aja krn bener bisa ngefek keikut previous url nya.
-   Karena aku abis ngotak atik tentang route url, aku jadi keinget link active yg ada di sidebar. Ketika lagi add atau delete, link active nya mati. Ada cara lain utk ngecek kalo link active. Kebetulan juga dikasih tau cara agar recognize link turunannya. Di akhir video dia benerin linknya tapi jelek bgt di cek atu" bertumpuk disitu pake or operator.
-   Baru kepikiran, utk tombol cancel brarti kan balik satu halaman, jadi ketimbang nulis ulang url manual di link nya, mending kita pake `url()->previous()` biar otomatis.
-   Aku kasih image preview saat upload cover buku pake jquery.
-   Di edit book, input category nya ku kasih elif selected biar keliatan langsung yg ter select.
-   Edit book cover ku bikin agar image lama keapus setelah diupdate yg baru.
-   Kalau input image cover book sama categories gk berubah ya gk ada yg diupdate.
-   Aku kasih paging di book, category dan user.
-   Search book di homepage untuk select category nya aku nyoba pake bootstrap-select.
    to-do
-   Beberapa query ku bikin spesifik biar gk lama load data dan ux utk user lebih baik karena udah terfilter
-   Bikin rent book untuk user client sekaligus update homepage book nya biar ada tombol untuk rent bagi client, aku gk tau ini guna atau gk karena gimana cara ngambil buku lagipula sejak awal system ini sebenernya akan dipake dimana dan siapa, admin doang kah? aku lanjut dibawah aja. Kalau mau bisa ku apus krn skrg jadi kepikiran utk bikin return book utk client.
-   blade component bisa ku bikin attribute boolean buat nentuin mau nampilin sesuatu atau gk, contoh di component table rent ku bikin attribute mau di paginate atau gk.
-   kepikiran dan akhirnya baru ketemu sebutannya dependent dropdown, dimana option select selanjutnya bergantung pada pilihan select sebelumnya. Akan lebih keren kalo diterapin di return book biar select user terus keluar buku apa yg lagi dipinjem. Kapan" kita coba.

-   Ini web sebenrnya fokus utk sapa sih, rata" admin semua, client cuma bisa liat", jadi flow business nya itu gimana? client dtg ke toko buku terus admin yg ngurus gitu? kalo gitu baru masuk akal. kalo gitu harus tau juga ini toko buku cuma satu atau byk cabang, juga brarti struktur database nya makin besar krn kek retail, data" spesifik per toko harus jelas misal ini buku ada di toko mana. Tapi karena bikin cukup sederhana jadi ywdhlah gitu aja ala kadarnya.
