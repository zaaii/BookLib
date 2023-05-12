CREATE DATABASE perpustakaan;

USE perpustakaan;

CREATE TABLE buku (
    id_buku INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    judul_buku VARCHAR(500) NOT NULL,
    penulis VARCHAR(500) NOT NULL,
    penerbit VARCHAR(250) NOT NULL,
    tahun_terbit INT NOT NULL,
    gambar_buku BLOB,
    pdf_buku BLOB,
    deskripsi_buku VARCHAR(1000)
);


INSERT INTO buku (id_buku, judul_buku, penulis, penerbit, tahun_terbit, gambar_buku, pdf_buku, deskripsi_buku) VALUES
(1, 'The Subtle Art of Not Giving a Fuck', 'Mark Manson', 'Harper', 2019, '1.jpg', 'self.pdf', 'Di suatu pagi yang cerah titan menyerang tembok kehidupan yang damai sudah tidak ada lagi dan mamaku dimakan titan'),
(2, 'Ego is the Enemy: The Fight to Master Our Greatest Opponent', 'Ryan Holiday', 'Profile selfs Ltd', 2016, '2.jpg', 'self.pdf', 'Tertawalah sebelum tertawa itu dilarang'),
(3, 'Everything Is F*cked: A self About Hope', 'Mark Manson', 'HarperCollins', 2019, '3.jpg', 'self.pdf', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor neque ut leo tempor, vitae malesuada quam ultricies. Curabitur pharetra nisi vel orci porta, at pharetra nibh posuere. Suspendisse potenti. Mauris id tincidunt mauris, nec cursus tellus. In sit amet interdum nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin non justo eget massa dignissim malesuada nec nec justo. Sed eu tellus ac turpis pellentesque rhoncus. Cras varius dolor vel tortor elementum, sit amet hendrerit metus vulputate.'),
(4, 'The Things You Can See Only When You Slow Down: How to Be Calm and Mindful in a Fast-Paced World', 'Haemin Sunim', 'Penguin selfs', 2017, '4.jpg', 'self.pdf', 'Deskripsi Buku 4'),
(5, 'Why We Sleep: Unlocking the Power of Sleep and Dreams', 'Matthew Walker, PhD', 'Scribner', 2017, '5.jpg', 'self.pdf', 'Deskripsi Buku 5');