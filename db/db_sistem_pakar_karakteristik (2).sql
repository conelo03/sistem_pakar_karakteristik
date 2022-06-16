-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 01:09 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sistem_pakar_karakteristik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(5) NOT NULL,
  `id_periksa` varchar(191) NOT NULL,
  `kode_karakteristik` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_periksa`, `kode_karakteristik`) VALUES
(7, 'periksa62ab2ac0b34dc', 'K13');

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `kode_indikator` varchar(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `kelompok` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`kode_indikator`, `nama`, `deskripsi`, `kelompok`) VALUES
('I12', 'Kadang anda akan menjadi orang yang pendiam dan memerlukan waktu untuk lebih akrab dengan orang  baru', 'Introvert', 4),
('I11', 'Anda merupakan orang yang sulit beradaptasi', 'Introvert', 4),
('I10', 'Anda bukan tipe yang mudah untuk bergaul dengan suatu kelompok baru', 'Introvert', 4),
('I9', 'Anda merasa sedikit sulit ketika harus berbicara didepan banyak orang', 'Introvert', 3),
('I8', 'Anda merasa pribadi yang membutuhkan privasi dan banyak waktu luang sendiri', 'Introvert', 3),
('I7', 'Anda bukan tipe yang lebih senang berbicara', 'Introvert', 3),
('I6', 'Berada dalam sebuah acara atau pesta membuat anda lebih bersemangat', 'Extrovert', 2),
('I5', 'Anda tidak merasa kesulitan berada dalam keramaian', 'Extrovert', 2),
('I4', 'Anda menganggap diri anda sebagai orang yang mudah bergaul', 'Extrovert', 2),
('I3', 'Anda senang memulai percakapan dengan orang lain', 'Extrovert', 1),
('I2', 'Anda biasanya lebih senang mengobrol dengan orang lain', 'Extrovert', 1),
('I1', 'Ketika telepon berbunyi anda cenderung segera mengangkat telepon ', 'Extrovert', 1),
('I13', 'Dalam menilai sesuatu, fakta yang aktual lebih penting dari apapun', 'Sensory', 5),
('I14', 'Ketika anda mendengar gosip, anda akan cenderung mencari tahu terlebih dahulu kebenarannya', 'Sensory', 5),
('I15', 'Dalam sebuah perbedaan pendapat, anda hanya akan mempercayai seseorang yang mempunyai bukti yang kuat', 'Sensory', 5),
('I16', 'Anda merupakan orang yang lebih percaya pada pengalaman anda', 'Sensory', 6),
('I17', 'Ketika dihadapkan dengan masalah anda menyelesaikan masalah tersebut dengan pengalaman yang anda punya, ketimbang mencari solusi baru', 'Sensory', 6),
('I18', 'Anda percaya bahwa pengalaman merupakan guru terbaik', 'Sensory', 6),
('I19', 'Saat memikirkan sesuatu anda merupakan pribadi yang sering berimajinasi', 'Intuitive', 7),
('I20', 'Anda lebih menyukai teori dari pada praktik', 'Intuitive', 7),
('I21', 'Anda senang merencanakan sesuatu tetapi jarang untuk merealisasikannya', 'Intuitive', 7),
('I22', 'Anda menyukai kata-kata kiasan', 'Intuitive', 8),
('I23', 'Anda lebih kagum pada penulis yang menggunakan perumpamaan untuk yang dimaksudkan', 'Intuitive', 8),
('I24', 'Pola berpikir anda sedikit lebih rumit', 'Intuitive', 8),
('I25', 'Anda merupakan pribadi yang tegas ketika berhubungan dengan orang lain', 'Thinking', 9),
('I26', 'Dalam menilai orang lain anda cenderung untuk bersikap objektif ', 'Thinking', 9),
('I27', 'Ketika anda memimpin sebuah tim, anda cenderung tegas dan disiplin ketimbang pemaaf dan toleran', 'Thinking', 9),
('I28', 'Secara umum anda merupakan orang yang bermuka tebal', 'Thinking', 10),
('I29', 'Saat dikomentari orang lain biasanya anda terlalu cuek', 'Thinking', 10),
('I30', 'Anda lebih sering dianggap sebagai orang yang kompetitif', 'Thinking', 10),
('I31', 'Perasaan anda lebih sering mengatur anda, ketimbang logika', 'Feeling', 11),
('I32', 'Anda lebih menganggap diri anda sebagai orang yang memikirkan perasaan orang lain dibanding rasional', 'Feeling', 11),
('I33', 'Anda merupakan pribadi yang mudah berempati', 'Feeling', 11),
('I34', 'Anda merupakan pribadi yang sensitif', 'Feeling', 12),
('I35', 'Saat anda dikomentari atau dikritik seseorang, anda biasanya sangat memikirkan hal tersebut', 'Feeling', 12),
('I36', 'Anda sering kali terlihat sebagai orang yang berhati lembut', 'Feeling', 12),
('I37', 'Anda merupakan pribadi yang berpegang kuat atas rencana awal dan tidak terpengaruh oleh kemungkinan baru', 'Judging', 13),
('I38', 'Saat sesuatu berjalan diluar rencana anda, anda akan merasa kesulitan dan tertekan', 'Judging', 13),
('I39', 'Lingkungan sekitar anda cenderung bersih dan rapi', 'Judging', 13),
('I40', 'Saat malam hari, anda lebih memilih menaati rambu lalu lintas dibanding melanggarnya', 'Judging', 14),
('I41', 'Anda lebih memilih memarkirkan kendaraan di tempat seharusnya dibanding dengan parkiran liar', 'Judging', 14),
('I42', 'Anda merasa tidak keberatan saat mengantri sesuatu', 'Judging', 14),
('I43', 'Teman anda melihat anda sebagai orang yang santai', 'Perceiving', 15),
('I44', 'Anda sangat menyukai fleksibilitas', 'Perceiving', 15),
('I45', 'Anda tidak suka bekerja dibawah tekanan', 'Perceiving', 15),
('I46', 'Dalam mencapai tujuan anda percaya solusi akan muncul dengan sendirinya seiring berjalannya kegiatan', 'Perceiving', 16),
('I47', 'Anda menyukai progress dibandingkan hasil', 'Perceiving', 16),
('I48', 'Ketika melaksanakan suatu kegiatan anda lebih membiarkan hal mengalir begitu saja, dan melakukan persiapan singkat', 'Perceiving', 16);

-- --------------------------------------------------------

--
-- Table structure for table `karakteristik`
--

CREATE TABLE `karakteristik` (
  `kode_karakteristik` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `solusi` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karakteristik`
--

INSERT INTO `karakteristik` (`kode_karakteristik`, `nama`, `deskripsi`, `solusi`) VALUES
('K1', 'ENFJ (THE MENTOR)', 'ENFJ', '<p>Secara keseluruhan anda merupakan orang yang ramah, supel, hangat dan pandai berbicara. ENFJ memiliki bakat komunikasi yang luar biasa untuk mempengaruhi seseorang, dan juga sangat loyal kepada orang yang dihormati. Anda memiliki kelebihan kecerdasan emosional bawaan dan sangat baik dalam berinteraksi dengan semua jenis kepribadian. Anda akan melakukan pekerjaan terbaik ketika berada didalam kelompok yang harmonis. Anda termasuk orang yang antusias dan memiliki energi untuk bekerja pada beberapa proyek sekaligus, meskipun seringkali anda dapat menjadi pribadi yang terkesan terburu-buru dan menjadi kurang sabar terhadap orang yang dirasa dapat menghambat anda.</p>\r\n\r\n<p>Sebagai orang yang terlahir menjadi pemimpin, anda akan lebih cocok berada didalam sebuah kelompok belajar dengan metode hafalan atau penerapan langsung. Tetapi anda harus berhati-hati karena anda seringkali akan merasa kurang nyaman apabila menerima kritikan keras. Oleh karena itu kepercayaan diri yang terkadang turun naik bisa menjadi kendala belajar anda. Terkadang anda terus menerus berusaha untuk mencapai target yang terkadang tidak realistis, dan itu membuat anda kesulitan mencapai ekspektasi.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Membangkitkan gairah orang lain dengan ide berkualitas dan antusiasme yang tinggi.</li>\r\n	<li>Mengorganisir orang-orang dan sumberdaya dengan baik.</li>\r\n	<li>Membangun moral, loyalitas, dan produktifitas.</li>\r\n	<li>Menjadi penasihat yang baik untuk orang lain.</li>\r\n	<li>Membuat tim menjadi harmonis.</li>\r\n	<li>Berpikir secara kreatif.</li>\r\n	<li>Berkomunikasi secara mengesankan.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Sering menghindari konflik dan konfrontasi.</li>\r\n	<li>Tidak memedulikan karyawan yang bekerja dibawah performa standar.</li>\r\n	<li>Terlalu sering membuat keputusan penting berdasarkan perasaan pribadi.</li>\r\n	<li>Terkadang memaksakan pendapat kepada seseorang.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Ir. Soekarno, Bung Tomo, H. Agus Salim, Nelson Mandela</p>\r\n'),
('K2', 'INFJ (THE COUNSELOR)', 'INFJ', '<p>Anda merupakan orang yang cenderung pendiam dan visioner tetapi memiliki banyak ide-ide kreatif dan memiliki rasa ingin tahu tinggi. Anda hanya akan berbagi dengan orang-orang terdekat dan tidak terlalu terbuka terhadap orang lain. Disamping itu anda memiliki rasa pemahaman yang tinggi terhadap orang lain dan senang jika bisa membantu mereka berkembang, sehingga dapat memberikan motivasi terhadap orang lain agar dapat mencapai titik potensi mereka. Meskipun sangat perhatian kepada orang lain, sebagai introvert anda tetap seringkali memerlukan waktu sendiri untuk mengisi waktu luang anda.</p>\r\n\r\n<p>INFJ umumnya unggul dalam hal struktur kalimat dan tidak takut untuk melakukan kesalahan. Pola belajar yang tepat untuk anda adalah belajar sendirian, karena anda seringkali lebih suka memahami segala sesuatu sendiri terlebih dahulu baru kemudian mempelajarinya bersama dengan orang lain, hanya saja anda harus berhati-hati untuk tidak terlalu keras pada diri sendiri dengan begitu proses pembelajaran akan tetap menyenangkan.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Seorang visioner.</li>\r\n	<li>Pelatih dan mentor yang baik.</li>\r\n	<li>Mengorganisir proyek dengan baik.</li>\r\n	<li>Mengenali orang yang tepat untuk tugas yang tepat.</li>\r\n	<li>Melihat cara-cara baru atau kreatif untuk menyelesaikan sebuah permasalahan.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Dapat menjadi terlalu idealis dan mengabaikan kepentingan utama.</li>\r\n	<li>Tidak berbakat dalam berpolitik.</li>\r\n	<li>Menghindari konflik, konfrontasim dan masalah-masalah yang mendasar.</li>\r\n	<li>Melebih-lebihkan atau menganggap kritik sebagai serangan terhadap diri anda.</li>\r\n	<li>Menetapkan tujuan secara tidak realistis.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Ki Hajar Dewantara, Mahatma Gandhi, Adolf Hitler, Carl Gustav Jung</p>\r\n'),
('K3', 'ENFP (THE CHAMPION)', 'ENFP', '<p>ENFP merupakan seseorang yang selalu bersemangat, kreatif, berjiwa bebas, dan selalu membawa suasana gembira. Anda mendapat energi dari ide-ide baru dan sering kali menyukai tantangan yang menuntut kecerdikan anda. Anda memperoleh motivasi belajar melalui kebebasan berekspresi secara kreatif yang didukung oleh lingkungan sekitar yang humoris dan menyenangkan, dan juga lingkungan yang bebas dan tidak terikat peraturan didalamnya.</p>\r\n\r\n<p>Dikarenakan memiliki banyak mimpi dan ide-ide besar, anda biasanya mencurahkan semuanya saat mempelajari sesuatu. Pola belajar anda akan semakin efektif apabila dikelilingi orang sekitar yang memiliki&nbsp; hasrat belajar yang sama dengan anda, dan seringkali akan mencari cara inovatif untuk belajar bersama. Walaupun demikian harus diingat bahwa belajar adalah proses dalam jangka panjang, anda memiliki kecenderungan untuk terlalu banyak berpikir dan menyerah dibawah tekanan, jadi akan lebih baik jika anda melakukannya secara perlahan tapi pasti.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Dapat menginspirasi orang lain.</li>\r\n	<li>Mengekspresikan diri pada hal yang menarik bagi anda dengan cara yang beragam.</li>\r\n	<li>Memiliki ide jauh kedepan.</li>\r\n	<li>Mampu membangun koneksi dengan cepat.</li>\r\n	<li>Membangun tim yang Felloyal dan efektif.</li>\r\n	<li>Membangun jaringan dengan orang yang baik lewat organisasi.</li>\r\n	<li>Fleksibel.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Sering kali menyepelekan dan melanggar aturan.</li>\r\n	<li>Dapat menjadi terlalu banyak berbicara dan sering menyimpang dari poin yang didiskusikan.</li>\r\n	<li>Terlalu sensitif terhadap kritik.</li>\r\n	<li>Menghindari konflik dan seringkali membiarkan masalah mengambang.</li>\r\n	<li>Bersemangat dengan proyek baru dan seringkali tidak menyelesaikan proyek yang lama.</li>\r\n	<li>Seringkali tidak memedulikan fakta dan kenyataan yang ada di lapangan.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Raditya Dika, Walt Disney, Mario Teguh, Robin Williams</p>\r\n'),
('K4', 'INFP (THE DREAMER)', 'INFP', '<p>INFP merupakan seseorang yang puitis dan senang menolong orang lain. Anda memiliki semangat kebebasan yang tinggi dan biasanya dipaksa untuk menyesuaikan diri dengan aturan dan norma yang berlaku di masyarakat, ini menjadikan anda sebagai pribadi yang memiliki jiwa fleksibel. Disisi lain anda adalah seseorang yang bijaksana, berwawasan, intuitif, dan jarang memaksakan ide kepada orang lain.&nbsp;</p>\r\n\r\n<p>Dikarenakan anda merupakan pribadi yang cenderung fleksibel membutuhkan banyak variasi dalam suatu hal agar tidak merasa bosan, anda membutuhkan motif yang kuat untuk bisa benar-benar belajar dalam suatu hal. Begitu menemukan alasannya, maka anda akan dengan mudah berkomitmen demi kemajuan diri sendiri, dan biasanya kemampuan anda akan lebih cepat untuk diasah, disamping itu juga anda akan cocok belajar dalam kelompok kecil atau sendiri.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Suka mencari kemungkinan baru.</li>\r\n	<li>Mendukung pengembangan diri orang lain.</li>\r\n	<li>Dapat berkonsentrasi dan bekerja sendirian dalam waktu yang lama.</li>\r\n	<li>Dapat bekerja tanpa banyak pengawasan.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Dapat menjadi teralalu idealis dan mengabaikan kepentingan yang utama.</li>\r\n	<li>Tidak terlalu sering berbicara dan menampakan diri.</li>\r\n	<li>Menganggap prinsip dan tujuan dana memiliki nilai yang lebih unggul dari orang lain.</li>\r\n	<li>Dapat menjadi pendiam dan selektif dalam berbicara.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : W.S Rendra, J.K Rowling, Chairil Anwar, Vincent van Gogh</p>\r\n'),
('K5', 'ESTP (THE PROMOTER)', 'ESTP', '<p>Anda merupakan seorang negosiator yang berbakat, bersemangat, cekatan dan berjiwa petualang. ESTP memiliki banyak energi, selera humor yang bagus dan optimis sebagai ciri khas diri. Kemudian anda juga hanya percaya pada apa yang anda amati sendiri dan cenderung hanya ingin melihat fakta-fakta. Anda merupakan tipe yang mudah menyesuaikan diri tetapi merasa mudah tertekan apabila bekerja dalam sebuah tekanan, anda seringkali membenci deadline yang ketat, dan pekerjaan yang berulang-ulang.&nbsp;</p>\r\n\r\n<p>Anda merupakan tipe yang tidak bisa menerima tekanan dalam jangka waktu panjang dan akan sulit menerima materi pembelajaran apabila tidak ada dorongan diri terlebih dahulu ataupun adanya faktor yang memaksa. Akan lebih baik jika anda menemukan kelompok belajar yang mampu membimbing anda, juga lingkungan yang dapat membuat hati anda merasa senang, banyaklah membuat <em>planning</em> pembelajaran yang bisa dilihat tiap hari agar anda tetap konsisten dengan hal tersebut.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Memiliki pemikiran yang praktis.</li>\r\n	<li>Membawa energy dan antusiasme pada proyek yang sedang dikerjakan.</li>\r\n	<li>Dapat bekerjasama dengan berbagai jenis orang.</li>\r\n	<li>Fleksibel dan menerima berbagai macam pemikiran.</li>\r\n	<li>Bergantung pada diri sendiri.</li>\r\n	<li>Sangat efektif dalam bernegosiasi.</li>\r\n	<li>Tertarik dan suka mengamati informasi yang factual.</li>\r\n	<li>Menganalisa sesuatu dengan cepat.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Cenderung santai dalam menanggapi peraturan, prosedur, dan otoritas.</li>\r\n	<li>Kadang-kadang tidak dapat berkomitmen.</li>\r\n	<li>Tidak menyukai <em>deadline</em> yang ketat, rutinitas yang berulang-ulang.</li>\r\n	<li>Tidak berpikir jauh kedepan.</li>\r\n	<li>Seringkali tidak mempersiapkan diri untuk suatu pertemuan atau proyek.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Chairul Tanjung, George W. Bush, Rano Karno, Arthur Conan Doyle</p>\r\n'),
('K6', 'ISTP (THE CRAFTER)', 'ISTP', '<p>ISTP adalah salah satu jenis kepribadian yang sangat berbakat dalam melakukan praktik atau uji coba khususnya mengenai alat mekanik. Secara alami anda biasanya senang mengerjakan sesuatu sendirian. Anda hanya akan berbagi pikiran jika seseorang bertanya kepada anda, karena anda seringkali asik dengan dunia anda sendiri.&nbsp;</p>\r\n\r\n<p>Mempunyai tim/kelompok kecil tanpa adanya kekangan/paksaan/tekanan didalamnya akan membuat anda berada dalam performa terbaik. Tetapi anda juga merupakan tipe yang senang mengutak-atik suatu permasalahan dan mendalami setiap detail secara penuh sendirian. Meskipun begitu ISTP menyukai keragaman, sehingga akan mudah bosan apabila terjebak dalam rutinitas, solusinya proses pembelajaran anda sebaiknya diselangi beberapa rutinitas baru agar proses pembelajaran tidak terasa membosankan.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Dapat menginspirasi orang lain.</li>\r\n	<li>Pengamat yang sangat jeli.</li>\r\n	<li>Memperhatikan informasi fakual dan nyata.</li>\r\n	<li>Menghargai dan mendorong efisiensi.</li>\r\n	<li>Suka menyelesaikan masalah dengan pendekatan yang logis.</li>\r\n	<li>Menjadi produktif ketika diberikan waktu sendirian untuk menyelesaikan sesuatu.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Dapat terlalu santai menghadapi peraturan dan prosedur yang dianut oleh orang lain, termasuk dalam menghadapi <em>deadline</em>.</li>\r\n	<li>Kadang-kadang melukai perasaan orang lain.</li>\r\n	<li>Tidak memiliki kontrol atas jadwal sendiri dan kontrol terhadap <em>deadline</em> yang ketat.</li>\r\n	<li>Mengabaikan sesuatu yang memerlukan persiapan.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Chris John, Michael Jordan, Rudi Hartono, Bruce Lee</p>\r\n'),
('K7', 'ESFP (THE PERFORMER)', 'ESFP', '<p>ESFP merupakan salah satu jenis tipe kepribadian yang bersemangat dan enerjik yang memberikan aura menyenangkan pada lingkungan sekitarnya. Anda merupakan seseorang yang aktif, suka bersosialisasi, dan gampang menyesuaikan diri. Anda memiliki ingatan visual yang baik dan unggul dalam mengamati detail-detail. Secara alami anda selalu ingin mencapai hasil secepat mungkin, hal ini membuat anda seringkali tidak sabar dengan prosedur dan rutinitas.&nbsp;</p>\r\n\r\n<p>ESFP harus berada di dekat orang lain agar bisa berkembang, sekali sudah menemukan teman yang asik anda akan sangat senang mencoba suatu hal baru, oleh karena itu anda sangat cocok memulai pola belajar dengan bantuan teman terdekat anda yang membuat anda merasa nyaman maka anda akan merasa lebih bersemangat.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Realistis terhadap apa yang seharusnya diselesaikan.</li>\r\n	<li>Memperhatikan dan mengingat informasi faktual.</li>\r\n	<li>Dapat menangani beberapa pekerjaan sekaligus dalam satu waktu.</li>\r\n	<li>Bereaksi cepat terhadap permasalahan atau krisis.</li>\r\n	<li>Membawa energi dan optimisme dalam proses pembelajaran.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Cenderung santai dalam menghadapi peraturan.</li>\r\n	<li>Memiliki kesulitan dalam mebuat rencana kedepan dan kadang tidak bisa berkomitmen.</li>\r\n	<li>Tidak menyukai <em>deadline</em> ketat, lingkungan yang tidak variatif, dan bekerja secara mandiri.</li>\r\n	<li>Menjadi frustasi di lingkungan yang terlalu serius.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Iwan Fals, Paulo Coelho, Bambang Pamungkas, Justin Bieber.</p>\r\n'),
('K8', 'ISFP (THE COMPOSER)', 'ISFP', '<p>ISFP adalah tipe yang berjiwa seni dan suka mencari pengalaman serta petualangan baru. Anda memiliki hasrat kecil untuk memimpin, namun memiliki dorongan untuk menyemangati orang lain. Sebuah kelompok kecil yang menyenangkan akan membuat anda berada di performa terbaik. Jika memungkinkan, anda cenderung lebih suka bergerak diluar peraturan dan normal yang dianut oleh orang lain, dan anda juga merupakan seseorang yang memiliki ingatan visual yang tajam. Karena anda memiliki jiwa seni dan senang mencari pengalaman, anda tidak akan ragu untuk melangkah mencari hal baru, tetapi anda terkadang cenderung semangat di awal dan akan kesulitan untuk fokus pada jadwal belajar yang terstruktur.</p>\r\n\r\n<p>Pola belajar yang tepat untuk anda adalah menemukan kelompok kecil yang nyaman tanpa adanya <em>deadline</em> yang bersifat mengekang, atau sebuah kelompok yang dapat membebaskan anda mencoba hal banyak sendiri terlebih dahulu. Materi akan mudah dipahami apabila anda menemukan cara penyajian yang unik dan fokus pada visualisasi.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Suka memulai dan melakukan perubahan.</li>\r\n	<li>Merangkul orang lain untuk mengerjakan tugas bersama-sama dengan kaya kooperatif.</li>\r\n	<li>Memberikan <em>feedback</em> yang mendukung kemajuan orang lain.</li>\r\n	<li>Menghargai kreativitas dan mengembangkan estetika dalam suatu lingkungan kelompok.</li>\r\n	<li>Paling produktif ketika dapat menyelesaikan pekerjaan secara mandiri.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Cenderung terlalu santai menghadapi peraturan dan prosedur yang diterapkan oleh orang lain.</li>\r\n	<li>Cenderung menghindari konflik atau menjadi defensif ketika dihadapkan pada konfrontasi.</li>\r\n	<li>Tidak menyukai <em>deadline</em> yang ketat.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Jonathan Ive, Affandi, Ismail Marzuki, Bob Dylan.</p>\r\n'),
('K9', 'ENTJ (THE COMANDER)', 'ENTJ', '<p>ENTJ merupakan tipe pemimpin tegas, kreatif, dan berkemauan keras yang selalu menemukan jalan untuk mencapai tujuan. Tipe kepribadian anda merupakan tipe yang memiliki pengetahuan yang sangat luas dikarenakan anda memiliki bakat alami mendominasi setiap proyek, mulai dari membuat visi hingga mewujudkan hal tersebut menjadi kenyataan. Anda memiliki kecintaan untuk terus mempelajari sesuatu, logika yang tajam, dan kemampuan eksekusi yang baik. Meskipun anda terkadang orang yang tidak sabaran dalam menghadapi seseorang yang anda anggap memiliki masalah yang tidak relevan dan berlebihan.</p>\r\n\r\n<p>Karena anda merupakan seseorang yang mempunyai rasa percaya diri tinggi hal ini sangat bermanfaat dalam proses pembelajaran. Berlatih bersama teman terdekat bisa menjadi salah satu cara efektif untuk belajar bagi ENTJ, ini akan menjadi kesempatan untuk mengetes kemampuan anda dalam situasi di kehidupan nyata. Anda umumnya memiliki target jangka panjang yang tinggi. Tetapi anda tetap harus berhati-hati jangan sampai standar ini membuat anda takut melakukan kesalahan dan malah menghambat prose pembelajaran anda.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Ramah dan enerjik.</li>\r\n	<li>Dapat melihat gambaran besar.</li>\r\n	<li>Mampu membuat keputusan yang logis.</li>\r\n	<li>Menggunakan cara pandang baru.</li>\r\n	<li>Terstruktur.</li>\r\n	<li>Melihat konsekuensi dalam jangka panjang.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Terlalu cepat mengambil keputusan dan mengabaikan pertimbangan praktisnya.</li>\r\n	<li>Cenderung terlalu kasar, keras atau penuntut.</li>\r\n	<li>Tidak memperhatikan keluhan atau kebutuhan orang lain.</li>\r\n	<li>Terkadang memanipulasi orang lain untuk mencapai suatu tujuan.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Dahlan Iskan, Jendral Sudirman, Steve Jobs, Napoleon Bonaparte.</p>\r\n'),
('K10', 'INTJ (THE MASTERMIND)', 'INTJ', '<p>INTJ adalah tipe kepribadian yang pemikir strategis, visioner yang selalu memiliki perencanaan kreatif untuk sesuatu. Anda sangat unggul dalam menghubungkan ide-ide dan fakta yang tampaknya tidak saling berkaitan. Melalui intuisi anda dapat membangun ide apapun yang anda inginkan, Anda juga memiliki kelebihan untuk merealisasikan semua tahap dari rencana anda, anda dapat membuat visi jangka panjang, merancang strategi, membangun perencanaan dan berbagai kemungkinan, serta membuat semua hal tersebut menjadi kenyataan.</p>\r\n\r\n<p>Anda merupakan tipe kepribadian yang biasanya mudah dalam meguasai suatu materi tertentu, karena anda merupakan tipe yang berfokus pada detail. Pola belajar yang cocok untuk anda adalah belajar secara independen atau <em>one-on-one&shy;. </em>Hal tersebut dikarenakan hal introvert anda yang lebih menyukai fokus tanpa gangguan, juga karena anda merupakan seseorang yang perfeksionis sehingga akan lebih efektif apabila anda bisa mengontrol agenda belajar anda sendiri.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Seringkali menjadi yang pertama dalam melihat gambaran besar dari suatu hal.</li>\r\n	<li>Mempunyai fokus tinggi dan berorientasi atas tujuan.</li>\r\n	<li>Menangani masalah yang rumit dengan baik.</li>\r\n	<li>Menyusun strategi dengan hasil akhir yang akurat.</li>\r\n	<li>Mengembangkan sistem baru yang canggih dengan teknologi.</li>\r\n	<li>Bekerjasama dengan baik bila bertemu seseorang yang kompeten.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Terkadang terlalu kasar, keras atau menuntut.</li>\r\n	<li>Biasanya enggan mengungkapkan pemikiran rumit agar tidak diterka atau dipertanyakan.</li>\r\n	<li>Terlalu memiliki pemikiran bahwa anda harus mengerjakan semuanya sendiri.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : B.J Habibie, Joko Widodo, Mark Zuckerberg, Nikola Tesla</p>\r\n'),
('K11', 'ENTP (THE INVENTOR)', 'ENTP', '<p>ENTP merupakan seseorang pemikir cerdas yang selalu tertantang untuk melakukan perdebatan dan diskusi-diskusi intelektual. Anda seringkali mengambil inisiatif dan mengatasi masalah dengan percaya bahwa semua hal dapat diatasi. Anda menyukai tantangan dan memiliki semangat mengejar tujuan baru hingga tidak menarik lagi bagi anda, ketika anda mengejar suatu tujuan baru anda dapat bekerja tanpa kenal lelah dan menularkan energi anda pada orang lain di sekitar anda.&nbsp;</p>\r\n\r\n<p>Anda memiliki kepribadian inovatif dan gaya belajar yang abstrak. Tetapi akan lebih efektif apabila anda melatih kemampuan anda bersama dengan orang lain khususnya dengan orang-orang yang kemampuannya diatas anda, sehingga anda akan menemukan pola belajar yang lebih menarik dan terus merasa tertantang. Tetapi anda perlu berhati-hati agar tidak terlalu mengambil banyak tantangan dalam satu waktu yang bersamaan, hal tersebut akan mengakibatkan sulitnya anda meluangkan waktu dan fokus untuk mencapai target yang diinginkan.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Bagus dalam memulai atau menginisiasi sebuah proyek.</li>\r\n	<li>Melihat sesuatu melalui gambaran besarnya.</li>\r\n	<li>Menginspirasi orang lain dengan antusiasme dan komunikasi yang bersemangat.</li>\r\n	<li>Memiliki minat pada masalah yang rumit,</li>\r\n	<li>Bersemangat dalam mencari solusi baru yang kreatif.</li>\r\n	<li>Menyukai perdebatan.</li>\r\n	<li>Dapat bekerja dengan banyak orang dan lingkup yang luas.</li>\r\n	<li>Bersedia mengambil resiko.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Terkadang terlalu banyak memulai proyek baru.</li>\r\n	<li>Dapat terlalu santai dengan sebuah <em>deadline </em>dan komitmen.</li>\r\n	<li>Mengintimidasi mereka yang kurang cerdas dan cekatan.</li>\r\n	<li>Kadang terlalu sering mengganti rencana dan strategi.</li>\r\n	<li>Sangat ingin menjadi pusat perhatian.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Bob Sadino, Steve Wozniak, Ricky Elson, Leonardo da Vinci.</p>\r\n'),
('K12', 'INTP (THE THINKER)', 'INTP', '<p>INTP merupakan kepribadian yang pemikir inovatif yang memiliki sifat haus akan ilmu pengetahuan. Anda merupakan orang yang berpikiran terbuka yang dapat melihat suatu masalah dengan berbagai sudut pandang. Anda sangat menyukai teori dan ide, sangat berbakat untuk mengubah teori penjadi pemahaman yang mudah dimengerti meskipun anda cenderung pendiam dan senang menyendiri atau berada disebuah kelompok kecil yang sangat benar-benar anda percayai.</p>\r\n\r\n<p>Karena anda memiliki gaya belajar yang super kritis, analitis dan konseptual, anda lebih cocok apabila melakukan proses pembelajaran sendiri. Tetapi terkadang anda akan merasa mudah bosan dengan gaya belajar yang menggunakan metode hafalan, disisi lain anda merupakan tipe yang mudah rentan <em>overthinking, </em>oleh karena itu dianjurkan sesekali anda harus berinteraksi dengan teman terdekat untuk bertukar pikiran dan agar anda dapat menghindari <em>overthinking </em>serta bisa lebih fokus dalam proses pembelajaran.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Selalu menciptakan dan mengembangkan suatu ide.</li>\r\n	<li>Menilai situasi secara logis dan analitis.</li>\r\n	<li>Terbuka dengan informasi yang baru.</li>\r\n	<li>Menuntut kualitas tinggi dan penggunaan kapasistas intelektual yang intensif.</li>\r\n	<li>Jarang terlibat di sebuah percakapan basa-basi.</li>\r\n	<li>Bisa sangat fokus dalam waktu lama terhadap sesuatu yang diminati.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Menjadi terlalu santai menghadapi <em>deadline</em>.</li>\r\n	<li>Terlalu banyak menciptakan suatu proyek sehingga seringkali tidak dapat menyelesaikannya.</li>\r\n	<li>Mengintimidasi orang yang kurang cekatan dan cerdas.</li>\r\n	<li>Dapat menjadi terlalu kritis, rumit, dan kompetitif.</li>\r\n	<li>Mengganti rencana dan strategi terlalu sering.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Gus Dur, Albert Einstein, Ridwan Kamil, Larry Page.</p>\r\n'),
('K13', 'ESTJ (THE SUPERVISOR)', 'ESTJ', '<p>ESTJ merupakan seseorang administrator yang berbakat dan tak tertandingi dalam keahlian manajerialnya. Anda lebih berpikir secara praktis dan terorganisir, anda juga tidak tertarik pada teori dan pemikiran abstrak kecuali memiliki aplikasi praktis dalam kehidupan. Anda merupakan pribadi yang selalu berusaha menyelesaikan suatu tugas ataupun masalah, tidak peduli seberapa sulit tugas tersebut.</p>\r\n\r\n<p>ESTJ merupakan tipe kepribadian yang menyukai aturan sehingga mempelajari sesuatu secara teroganisir akan terasa menyenangkan bagi anda. Karena anda juga merupakan pribadi yang senang bersosialisasi, pola belajar secara berkelompok akan lebih memudahkan anda. Tetapi anda terkadang terlalu memikirkan apa yang dipikirkan orang lain, sehingga akhirnya menghindar untuk terlibat dalam percakapan yang bersifat spontan kecuali anda memiliki gagasan kuat mengenai apa yang akan anda katakan. Tetapi itu tidak jadi masalah, selama anda dapat menemukan kelompok yang bisa bertukar pikiran dan maju bersama dalam proses pembelajaran.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Stabil dan dapat diprediksi.</li>\r\n	<li>Tegas.</li>\r\n	<li>Berharap dapat bekerja dengan standar tinggi.</li>\r\n	<li>Menggunakan sumber daya secara efisien.</li>\r\n	<li>Menghormati aturan dan prosedur yang telah ditetapkan.</li>\r\n	<li>Mendapatkan hasil yang baik dengan pengaturan waktu dan tugas yang jelas.</li>\r\n	<li>Mengilhami kepercayaan diri.</li>\r\n	<li>Menyelesaikan tugas tepat waktu dan sesuai perkiraan.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Terlalu dini mengabaikan ide baru.</li>\r\n	<li>Terlalu fokus pada kekurangan orang lain ketika menilai usaha mereka.</li>\r\n	<li>Terpaku dengan cara yang telah teruji untuk mengerjakan sesuatu.</li>\r\n	<li>Terlalu agresif dan menuntut ide anda diaplikasikan.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Soeharto, Jusuf Kalla, Michelle Obama, Emma Watson</p>\r\n'),
('K14', 'ISTJ (THE INSPECTOR)', 'ISTJ', '<p>ISTJ merupakan seseorang yang cermat, teliti, berdedikasi tinggi, dan bertanggung jawab dalam menjalankan tugas. Anda memiliki ingatan yang kuat tentang apa yang orang katakan dan lakukan dengan ketelitian tinggi. Disamping itu anda juga seseorang yang realistis dan praktis juga berkomitmen secara serius itu menjadikan anda menjadi orang yang secara konsisten untuk mencapai sebuah tujuan.</p>\r\n\r\n<p>ISTJ cenderung memusatkan segala perhatiannya untuk menyelesaikan segala latihan atau ujian yang bisa dikerjakan. Oleh karena itu anda akan merasa lebih efektif apabila belajar fokus sendiri didalam kamar ketimbang mengandalkan orang lain untuk mendapatkan bantuan. Meskipun hal tersebut menjadi sebuah sisi positif untuk hal ketekunan yang membuat anda akan sangat menjadi teliti dalam setiap detail, anda juga harus sesekali mecoba melihat gambaran umum agar dapat melihat dari perspektif lain.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Secara alami dapat beradaptasi terhadap posisi yang diberikan dalam tugas kelompok.</li>\r\n	<li>Mengerjakan tugas secara akurat.</li>\r\n	<li>Membuat dan menegakkan kebijakan.</li>\r\n	<li>Adil ketika berurusan dengan orang lain.</li>\r\n	<li>Tergas, terorganisir, dan umumnya selalu menyelesaikan tugas tepat waktu.</li>\r\n	<li>Memiliki tingkat konsentrasi tinggi.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Terlalu dini mengabaikan sebuah ide baru.</li>\r\n	<li>Terlalu fokus pada kekurangan orang lain ketika menilai usaha orang lain.</li>\r\n	<li>Terburu-buru menekankan pada hasil jangka pendek.</li>\r\n	<li>Terpaku dengan cara yang telah ada untuk mengerjakan sesuatu.</li>\r\n	<li>Kaku dalam menilai bagaimana orang lain seharusnya menjalankan tugas dan tagging jawabnya.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Moh. Hatta, Sigmund Freud, Dr. Soetomo, George Washington</p>\r\n'),
('K15', 'ESFJ (THE PROVIDER)', 'ESFJ', '<p>ESFJ merupakan seseorang yang simpatik, memiliki banyak teman, dan sangat bersemangat dalam menolong orang lain. Anda seringkali memastikan kesejahteraan orang-orang di sekitar anda, karena anda umumnya memiliki rasa ingin tahu yang tinggi terhadap orang lain.Anda senang bekerja dengan sesuatu yang nyata dan percaya pada pengalaman kongkrit yang pernah anda alami. Mencoba ide-ide baru membuat anda tidak nyaman, dan anda umumnya menghindari banyak perubahan dan meminimalkan pemikiran yang jauh berorientasi ke depan, karena lebih memilih fokus untuk pada apa yang dijalani sekarang.</p>\r\n\r\n<p>Anda umumnya membutuhkan banyak dukungan dan pengakuan dari orang lain ketika mempelajari hal baru, jadi proses pembelajaran berkelompok akan sangat membantu anda ditambah dengan pribadi anda yang praktis. Anda hanya harus berhati-hati agar tidak terlalu keras pada diri sendiri saat melakukan kesalahan, jangan sampai rasa takut anda terhadap kritik membuat anda sulit berkembang.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Memiliki dorongan yang kuat untuk membantu orang lain.</li>\r\n	<li>Mengakui dan menghormati rantai kepemimpinan.</li>\r\n	<li>Jeli terhadap detail.</li>\r\n	<li>Menerapkan akal sehat berorientasi praktik.</li>\r\n	<li>Memotivasi orang lain untuk meraih tujuan.</li>\r\n	<li>Setia pada suatu proyek/hal sampai hal tersebut selesai.</li>\r\n	<li>Menyelesaikan tugas tepat waktu dan sesuai dengan perkiraan.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Terlalu fokus dengan detail dan mengabaikan gambaran besar.</li>\r\n	<li>Membutuhkan pujian dan apresiasi yang tinggi.</li>\r\n	<li>Tidak dapat menangani situasi kompetitif dengan baik.</li>\r\n	<li>Cenderung untuk tetap setia pada apa yang telah dikerjakan.</li>\r\n	<li>Secara alamiah kesulitan melihat kemungkinan baru.</li>\r\n	<li>Mengambil keputusan terlalu cepat.</li>\r\n</ol>\r\n\r\n<p>Tokoh terkenal : Najwa Shihab, Prince William, Megawati Soekarno Putri, Mariah Carey.</p>\r\n'),
('K16', 'ISFJ (THE PROTECTOR)', 'ISFJ', '<p>ISFJ merupakan tipe kepribadian yang sangat berbakat dalam mengasuh, menolong, setia, dan murah hati. Anda merupakan seseorang yang memiliki etika kerja tinggi, berkomitmen, praktis, berorientasi terhadap detail dan teliti. Biasanya anda merupakan tipe yang menempatkan kebutuhan orang lain diatas kebutuhannya sendiri, karena anda sangat peka terhadap perasaan orang lain.</p>\r\n\r\n<p>Anda dapat tergolong salah satu tipe <em>introvert </em>yang lumayan aktif secara sosial, tetapi jika menyangkut soal belajar, akan lebih baik jika anda belajar sendiri karena anda cenderung menyukai ruangan yang tenang ketika mempelajari sesuatu, walau demikian anda juga tipe yang tidak akan menemui masalah apabila ada teman yang ingin belajar bersama karena sifat anda yang tidak keberatan untuk menolong dan membantu.</p>\r\n\r\n<p>Kelebihan :</p>\r\n\r\n<ol>\r\n	<li>Dapat mengorganisir orang lain untuk menyelesaikan tujuan yang jelas.</li>\r\n	<li>Mengamati kebutuhan orang lain dan membantu mereka kapanpun anda bisa.</li>\r\n	<li>Memiliki cara praktis tentang apa saja yang dibutuhkan dan bagaimana melakukannya.</li>\r\n	<li>Mendukung orang lain dan memberi semangat kepada orang lain.</li>\r\n	<li>Bekerja dengan baik dalam tim.</li>\r\n	<li>Tidak digerakkan oleh ego.</li>\r\n	<li>Mengikuti aturan.</li>\r\n</ol>\r\n\r\n<p>Kekurangan :</p>\r\n\r\n<ol>\r\n	<li>Membutuhkan dukungan dan akan putus asa jika dukungan tersebut tidak diungkapkan.</li>\r\n	<li>Bereaksi berlebihan terhadap kompetisi dan pertikaian.</li>\r\n	<li>Mungkin terlalu berhati-hati dengan cara-cara baru.</li>\r\n	<li>Dapat menjadi kurang tegas dan kurang mampu berterus terang secara langsung.</li>\r\n</ol>\r\n\r\n<p>&nbsp;Tokoh terkenal : SBY, Kak Seto, Kate Middleton, Bruce Willis.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(11) NOT NULL,
  `id_periksa` varchar(200) NOT NULL,
  `no_telp` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `umur` int(2) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `id_user`, `nama`, `id_periksa`, `no_telp`, `alamat`, `umur`, `jenis_kelamin`, `created_date`) VALUES
(1, 1, 'Rama', 'periksa61e811aea445b', '089', 'Bandung', 23, 'Laki - Laki', '2022-01-19 13:27:10'),
(2, 1, 'Rama', 'periksa61e812bad8380', '089', 'Bandung', 23, 'Laki - Laki', '2022-01-19 13:31:38'),
(3, 4, 'rasya', 'periksa61e81ddcc8397', '085', 'bandung', 22, 'Perempuan', '2022-01-19 14:19:08'),
(4, 1, 'Rama', 'periksa62037fcfdc499', '089', 'Bandung', 23, 'Laki - Laki', '2022-02-09 08:48:15'),
(5, 7, 'fauza', 'periksa62494a4b6ce79', '08111', 'bandung', 23, 'Perempuan', '2022-04-03 07:18:35'),
(6, 7, 'fauza', 'periksa624c3a750a353', '08111', 'bandung', 22, 'Perempuan', '2022-04-05 12:47:49'),
(7, 1, 'Rama', 'periksa62ab252f1c574', '089', 'Bandung', 23, 'Laki - Laki', '2022-06-16 12:42:23'),
(8, 1, 'Rama', 'periksa62ab27421afab', '089', 'Bandung', 23, 'Laki - Laki', '2022-06-16 12:51:14'),
(9, 1, 'Rama', 'periksa62ab2a9323e72', '089', 'Bandung', 23, 'Laki - Laki', '2022-06-16 13:05:23'),
(10, 1, 'Rama', 'periksa62ab2ac0b34dc', '089', 'Bandung', 23, 'Laki - Laki', '2022-06-16 13:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `relasi`
--

CREATE TABLE `relasi` (
  `id_relasi` int(5) NOT NULL,
  `kode_indikator` varchar(11) NOT NULL,
  `kode_karakteristik` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relasi`
--

INSERT INTO `relasi` (`id_relasi`, `kode_indikator`, `kode_karakteristik`) VALUES
(932, 'I14', 'K16'),
(931, 'I13', 'K16'),
(930, 'I12', 'K16'),
(929, 'I11', 'K16'),
(928, 'I10', 'K16'),
(927, 'I9', 'K16'),
(926, 'I8', 'K16'),
(925, 'I7', 'K16'),
(924, 'I42', 'K15'),
(923, 'I41', 'K15'),
(922, 'I40', 'K15'),
(921, 'I39', 'K15'),
(920, 'I38', 'K15'),
(919, 'I37', 'K15'),
(918, 'I36', 'K15'),
(917, 'I35', 'K15'),
(916, 'I34', 'K15'),
(915, 'I33', 'K15'),
(914, 'I32', 'K15'),
(913, 'I31', 'K15'),
(912, 'I18', 'K15'),
(911, 'I17', 'K15'),
(910, 'I16', 'K15'),
(909, 'I15', 'K15'),
(908, 'I14', 'K15'),
(907, 'I13', 'K15'),
(906, 'I6', 'K15'),
(905, 'I5', 'K15'),
(904, 'I4', 'K15'),
(903, 'I3', 'K15'),
(902, 'I2', 'K15'),
(901, 'I1', 'K15'),
(900, 'I42', 'K14'),
(899, 'I41', 'K14'),
(898, 'I40', 'K14'),
(897, 'I39', 'K14'),
(896, 'I38', 'K14'),
(895, 'I37', 'K14'),
(894, 'I30', 'K14'),
(893, 'I29', 'K14'),
(892, 'I28', 'K14'),
(891, 'I27', 'K14'),
(890, 'I26', 'K14'),
(889, 'I25', 'K14'),
(888, 'I18', 'K14'),
(887, 'I17', 'K14'),
(886, 'I16', 'K14'),
(885, 'I15', 'K14'),
(884, 'I14', 'K14'),
(883, 'I13', 'K14'),
(882, 'I12', 'K14'),
(881, 'I11', 'K14'),
(880, 'I10', 'K14'),
(879, 'I9', 'K14'),
(878, 'I8', 'K14'),
(877, 'I7', 'K14'),
(876, 'I42', 'K13'),
(875, 'I41', 'K13'),
(874, 'I40', 'K13'),
(873, 'I39', 'K13'),
(872, 'I38', 'K13'),
(871, 'I37', 'K13'),
(870, 'I30', 'K13'),
(869, 'I29', 'K13'),
(868, 'I28', 'K13'),
(867, 'I27', 'K13'),
(866, 'I26', 'K13'),
(865, 'I25', 'K13'),
(864, 'I18', 'K13'),
(863, 'I17', 'K13'),
(862, 'I16', 'K13'),
(861, 'I15', 'K13'),
(860, 'I14', 'K13'),
(859, 'I13', 'K13'),
(858, 'I6', 'K13'),
(857, 'I5', 'K13'),
(856, 'I4', 'K13'),
(855, 'I3', 'K13'),
(854, 'I2', 'K13'),
(853, 'I1', 'K13'),
(852, 'I48', 'K12'),
(851, 'I47', 'K12'),
(850, 'I46', 'K12'),
(849, 'I45', 'K12'),
(848, 'I44', 'K12'),
(847, 'I43', 'K12'),
(846, 'I30', 'K12'),
(845, 'I29', 'K12'),
(844, 'I28', 'K12'),
(843, 'I27', 'K12'),
(842, 'I26', 'K12'),
(841, 'I25', 'K12'),
(840, 'I24', 'K12'),
(839, 'I23', 'K12'),
(838, 'I22', 'K12'),
(837, 'I21', 'K12'),
(836, 'I20', 'K12'),
(835, 'I19', 'K12'),
(834, 'I12', 'K12'),
(833, 'I11', 'K12'),
(832, 'I10', 'K12'),
(831, 'I9', 'K12'),
(830, 'I8', 'K12'),
(829, 'I7', 'K12'),
(828, 'I48', 'K11'),
(827, 'I47', 'K11'),
(826, 'I46', 'K11'),
(825, 'I45', 'K11'),
(824, 'I44', 'K11'),
(823, 'I43', 'K11'),
(822, 'I30', 'K11'),
(821, 'I29', 'K11'),
(820, 'I28', 'K11'),
(819, 'I27', 'K11'),
(818, 'I26', 'K11'),
(817, 'I25', 'K11'),
(816, 'I24', 'K11'),
(815, 'I23', 'K11'),
(814, 'I22', 'K11'),
(813, 'I21', 'K11'),
(812, 'I20', 'K11'),
(811, 'I19', 'K11'),
(810, 'I6', 'K11'),
(809, 'I5', 'K11'),
(808, 'I4', 'K11'),
(807, 'I3', 'K11'),
(806, 'I2', 'K11'),
(805, 'I1', 'K11'),
(804, 'I42', 'K10'),
(803, 'I41', 'K10'),
(802, 'I40', 'K10'),
(801, 'I39', 'K10'),
(800, 'I38', 'K10'),
(799, 'I37', 'K10'),
(798, 'I30', 'K10'),
(797, 'I29', 'K10'),
(796, 'I28', 'K10'),
(795, 'I27', 'K10'),
(794, 'I26', 'K10'),
(793, 'I25', 'K10'),
(792, 'I24', 'K10'),
(791, 'I23', 'K10'),
(790, 'I22', 'K10'),
(789, 'I21', 'K10'),
(788, 'I20', 'K10'),
(787, 'I19', 'K10'),
(786, 'I12', 'K10'),
(785, 'I11', 'K10'),
(784, 'I10', 'K10'),
(783, 'I9', 'K10'),
(782, 'I8', 'K10'),
(781, 'I7', 'K10'),
(780, 'I42', 'K9'),
(779, 'I41', 'K9'),
(778, 'I40', 'K9'),
(777, 'I39', 'K9'),
(776, 'I38', 'K9'),
(775, 'I37', 'K9'),
(774, 'I30', 'K9'),
(773, 'I29', 'K9'),
(772, 'I28', 'K9'),
(771, 'I27', 'K9'),
(770, 'I26', 'K9'),
(769, 'I25', 'K9'),
(768, 'I24', 'K9'),
(767, 'I23', 'K9'),
(766, 'I22', 'K9'),
(765, 'I21', 'K9'),
(764, 'I20', 'K9'),
(763, 'I19', 'K9'),
(762, 'I6', 'K9'),
(761, 'I5', 'K9'),
(760, 'I4', 'K9'),
(759, 'I3', 'K9'),
(758, 'I2', 'K9'),
(757, 'I1', 'K9'),
(756, 'I48', 'K8'),
(755, 'I47', 'K8'),
(754, 'I46', 'K8'),
(753, 'I45', 'K8'),
(752, 'I44', 'K8'),
(751, 'I43', 'K8'),
(750, 'I36', 'K8'),
(749, 'I35', 'K8'),
(748, 'I34', 'K8'),
(747, 'I33', 'K8'),
(746, 'I32', 'K8'),
(745, 'I31', 'K8'),
(744, 'I18', 'K8'),
(743, 'I17', 'K8'),
(742, 'I16', 'K8'),
(741, 'I15', 'K8'),
(740, 'I14', 'K8'),
(739, 'I13', 'K8'),
(738, 'I12', 'K8'),
(737, 'I11', 'K8'),
(736, 'I10', 'K8'),
(735, 'I9', 'K8'),
(734, 'I8', 'K8'),
(733, 'I7', 'K8'),
(732, 'I48', 'K7'),
(731, 'I47', 'K7'),
(730, 'I46', 'K7'),
(729, 'I45', 'K7'),
(728, 'I44', 'K7'),
(727, 'I43', 'K7'),
(726, 'I36', 'K7'),
(725, 'I35', 'K7'),
(724, 'I34', 'K7'),
(723, 'I33', 'K7'),
(722, 'I32', 'K7'),
(721, 'I31', 'K7'),
(720, 'I18', 'K7'),
(719, 'I17', 'K7'),
(718, 'I16', 'K7'),
(717, 'I15', 'K7'),
(716, 'I14', 'K7'),
(715, 'I13', 'K7'),
(714, 'I6', 'K7'),
(713, 'I5', 'K7'),
(712, 'I4', 'K7'),
(711, 'I3', 'K7'),
(710, 'I2', 'K7'),
(709, 'I1', 'K7'),
(708, 'I48', 'K6'),
(707, 'I47', 'K6'),
(706, 'I46', 'K6'),
(705, 'I45', 'K6'),
(704, 'I44', 'K6'),
(703, 'I43', 'K6'),
(702, 'I30', 'K6'),
(701, 'I29', 'K6'),
(700, 'I28', 'K6'),
(699, 'I27', 'K6'),
(698, 'I26', 'K6'),
(697, 'I25', 'K6'),
(696, 'I18', 'K6'),
(695, 'I17', 'K6'),
(694, 'I16', 'K6'),
(693, 'I15', 'K6'),
(692, 'I14', 'K6'),
(691, 'I13', 'K6'),
(690, 'I12', 'K6'),
(689, 'I11', 'K6'),
(688, 'I10', 'K6'),
(687, 'I9', 'K6'),
(686, 'I8', 'K6'),
(685, 'I7', 'K6'),
(684, 'I48', 'K4'),
(683, 'I47', 'K4'),
(682, 'I46', 'K4'),
(681, 'I45', 'K4'),
(680, 'I44', 'K4'),
(679, 'I43', 'K4'),
(678, 'I36', 'K4'),
(677, 'I35', 'K4'),
(676, 'I34', 'K4'),
(675, 'I33', 'K4'),
(674, 'I32', 'K4'),
(673, 'I31', 'K4'),
(672, 'I24', 'K4'),
(671, 'I23', 'K4'),
(670, 'I22', 'K4'),
(669, 'I21', 'K4'),
(668, 'I20', 'K4'),
(667, 'I19', 'K4'),
(666, 'I12', 'K4'),
(665, 'I11', 'K4'),
(664, 'I10', 'K4'),
(663, 'I9', 'K4'),
(662, 'I8', 'K4'),
(661, 'I7', 'K4'),
(660, 'I42', 'K2'),
(659, 'I41', 'K2'),
(658, 'I40', 'K2'),
(657, 'I39', 'K2'),
(656, 'I38', 'K2'),
(655, 'I37', 'K2'),
(654, 'I36', 'K2'),
(653, 'I35', 'K2'),
(652, 'I34', 'K2'),
(651, 'I33', 'K2'),
(650, 'I32', 'K2'),
(649, 'I31', 'K2'),
(648, 'I24', 'K2'),
(647, 'I23', 'K2'),
(646, 'I22', 'K2'),
(645, 'I21', 'K2'),
(644, 'I20', 'K2'),
(643, 'I19', 'K2'),
(642, 'I12', 'K2'),
(641, 'I11', 'K2'),
(640, 'I10', 'K2'),
(639, 'I9', 'K2'),
(638, 'I8', 'K2'),
(637, 'I7', 'K2'),
(636, 'I48', 'K5'),
(635, 'I47', 'K5'),
(634, 'I46', 'K5'),
(633, 'I45', 'K5'),
(632, 'I44', 'K5'),
(631, 'I43', 'K5'),
(630, 'I30', 'K5'),
(629, 'I29', 'K5'),
(628, 'I28', 'K5'),
(627, 'I27', 'K5'),
(626, 'I26', 'K5'),
(625, 'I25', 'K5'),
(624, 'I18', 'K5'),
(623, 'I17', 'K5'),
(622, 'I16', 'K5'),
(621, 'I15', 'K5'),
(620, 'I14', 'K5'),
(619, 'I13', 'K5'),
(618, 'I6', 'K5'),
(617, 'I5', 'K5'),
(616, 'I4', 'K5'),
(615, 'I3', 'K5'),
(614, 'I2', 'K5'),
(613, 'I1', 'K5'),
(612, 'I48', 'K3'),
(611, 'I47', 'K3'),
(610, 'I46', 'K3'),
(609, 'I45', 'K3'),
(608, 'I44', 'K3'),
(607, 'I43', 'K3'),
(606, 'I36', 'K3'),
(605, 'I35', 'K3'),
(604, 'I34', 'K3'),
(603, 'I33', 'K3'),
(602, 'I32', 'K3'),
(601, 'I31', 'K3'),
(600, 'I24', 'K3'),
(599, 'I23', 'K3'),
(598, 'I22', 'K3'),
(597, 'I21', 'K3'),
(596, 'I20', 'K3'),
(595, 'I19', 'K3'),
(594, 'I6', 'K3'),
(593, 'I5', 'K3'),
(592, 'I4', 'K3'),
(591, 'I3', 'K3'),
(590, 'I2', 'K3'),
(589, 'I1', 'K3'),
(588, 'I42', 'K1'),
(587, 'I41', 'K1'),
(586, 'I40', 'K1'),
(585, 'I39', 'K1'),
(584, 'I38', 'K1'),
(583, 'I37', 'K1'),
(582, 'I36', 'K1'),
(581, 'I35', 'K1'),
(580, 'I34', 'K1'),
(579, 'I33', 'K1'),
(578, 'I32', 'K1'),
(577, 'I31', 'K1'),
(576, 'I24', 'K1'),
(575, 'I23', 'K1'),
(574, 'I22', 'K1'),
(573, 'I21', 'K1'),
(572, 'I20', 'K1'),
(571, 'I19', 'K1'),
(570, 'I6', 'K1'),
(569, 'I5', 'K1'),
(568, 'I4', 'K1'),
(567, 'I3', 'K1'),
(566, 'I2', 'K1'),
(934, 'I16', 'K16'),
(933, 'I15', 'K16'),
(565, 'I1', 'K1'),
(935, 'I17', 'K16'),
(936, 'I18', 'K16'),
(937, 'I31', 'K16'),
(938, 'I32', 'K16'),
(939, 'I33', 'K16'),
(940, 'I34', 'K16'),
(941, 'I35', 'K16'),
(942, 'I36', 'K16'),
(943, 'I37', 'K16'),
(944, 'I38', 'K16'),
(945, 'I39', 'K16'),
(946, 'I40', 'K16'),
(947, 'I41', 'K16'),
(948, 'I42', 'K16');

-- --------------------------------------------------------

--
-- Table structure for table `rule_temp`
--

CREATE TABLE `rule_temp` (
  `id` int(5) NOT NULL,
  `id_periksa` varchar(200) NOT NULL,
  `pilihan` varchar(100) NOT NULL,
  `jawaban` varchar(200) NOT NULL,
  `kelompok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `jenis_kelamin`, `no_hp`, `alamat`, `email`, `username`, `password`) VALUES
(1, 'Rama', 'Laki - Laki', '089', 'Bandung', 'rama@email.com', 'rama', 'rama'),
(3, 'tes', 'Laki - Laki', '089', 'Bandung', 'tes@a.c', 'tes', 'tes'),
(4, 'rasya', 'Perempuan', '085', 'bandung', 'rasyaafirda@gmail.com', 'rasyaafw', 'rasya123'),
(7, 'fauza', 'Perempuan', '08111', 'bandung', 'fauzaamalia@gmail.com', 'fauza123', '0987');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`username`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`kode_indikator`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `karakteristik`
--
ALTER TABLE `karakteristik`
  ADD PRIMARY KEY (`kode_karakteristik`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `relasi`
--
ALTER TABLE `relasi`
  ADD PRIMARY KEY (`id_relasi`),
  ADD KEY `id_gejala` (`kode_indikator`),
  ADD KEY `id_penyakit` (`kode_karakteristik`);

--
-- Indexes for table `rule_temp`
--
ALTER TABLE `rule_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `relasi`
--
ALTER TABLE `relasi`
  MODIFY `id_relasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=949;

--
-- AUTO_INCREMENT for table `rule_temp`
--
ALTER TABLE `rule_temp`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
