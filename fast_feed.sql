-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th11 22, 2025 lúc 04:52 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fast_feed`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(1, 1, 2, 'Dạo phố Hà Nội vào những ngày này thực sự rất dễ chịu, càng làm cho tôi thêm yêu Hà Nội!', '2025-11-22 03:03:38'),
(2, 2, 2, 'Thực sự tôi rất thích phong cảnh, cũng như là những trải nghiệm du lịch đáng nhớ mà Sapa mang lại. Nếu có dịp, tôi chắc chắn sẽ quay trở lại!', '2025-11-22 03:07:40'),
(3, 3, 2, 'Hội An làm cho tôi luôn có cảm giác bình yên, con người nơi đây rất thân thiện và mến khách. Mọi người nhớ đến Hội An để có những trải nghiệm đáng nhớ nhé!', '2025-11-22 03:08:30'),
(4, 1, 1, 'Cảm ơn bạn đã chia sẻ cảm nhận!', '2025-11-22 03:10:44'),
(5, 1, 3, 'Tôi rất thích không khí Hà Nội vào những ngày đầu mùa như thế này bên cốc cà phê vào mỗi sớm mai!', '2025-11-22 03:15:48'),
(6, 1, 4, 'Hà Nội mùa nào cũng có nét đẹp riêng, thực sự là một trong những địa điểm du lịch không thể bỏ qua', '2025-11-22 03:17:08'),
(7, 2, 4, 'Sapa thực sự rất đẹp!', '2025-11-22 03:18:41'),
(8, 3, 4, 'Tôi vẫn nhớ cảm giác dạo quanh Phố Cổ vào đêm, nơi đây quả thực rất đẹp!', '2025-11-22 03:19:57'),
(9, 2, 3, 'Nghe thật thú vị, có lẽ du lịch lần tới, tôi sẽ ghé lại nơi đây!', '2025-11-22 03:20:49'),
(10, 3, 3, 'Mọi người nhớ nghé Hội An nha, không những con người thân thiện mà đồ ăn ở đây cũng rất ngon nữa!', '2025-11-22 03:21:29'),
(11, 2, 1, 'Cảm ơn những ý kiến của mọi người nhé! Chúc mọi người có những chuyến đi thật đáng nhớ!', '2025-11-22 03:23:03'),
(12, 3, 1, 'Cảm ơn những chia sẻ của mọi người. Chúc mọi người luôn vui vẻ, bình an và cùng đón nhận những bài viết tiếp theo nhé!', '2025-11-12 03:24:47'),
(13, 4, 1, 'Mọi người đã ai đến Huế chưa nhỉ? Nêu cảm nhận và chia sẻ để mọi người cùng biết nhé!', '2025-11-22 04:25:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`id`, `name`, `content`, `user_id`, `image`, `created_at`) VALUES
(1, 'HÀ NỘI: THỦ ĐÔ CỦA NHỮNG NGÀY ĐẦU MÙA VÀ SỰ BÌNH YÊN TRONG TỪNG HƠI THỞ', '<p>C&oacute; một H&agrave; Nội khiến m&igrave;nh cứ muốn quay lại ho&agrave;i, kh&ocirc;ng phải v&igrave; những c&ocirc;ng tr&igrave;nh lớn hay điểm check-in sang chảnh, m&agrave; v&igrave; những điều nhỏ x&iacute;u nhưng rất &ldquo;H&agrave; Nội&rdquo; &ndash; ly tr&agrave; đ&aacute; vỉa h&egrave;, tiếng rao đ&ecirc;m xa xa, một buổi s&aacute;ng tinh mơ đi bộ hồ Gươm.</p>\r\n\r\n<p>H&agrave; Nội m&ugrave;a n&agrave;o cũng đẹp, nhưng đẹp nhất c&oacute; lẽ l&agrave; những ng&agrave;y đầu thu. Buổi s&aacute;ng mở cửa kh&aacute;ch sạn, gi&oacute; m&aacute;t l&ugrave;a v&agrave;o, mang theo m&ugrave;i hoa sữa thoang thoảng v&agrave; c&aacute;i se lạnh đủ khiến người ta tỉnh t&aacute;o. M&igrave;nh th&iacute;ch những s&aacute;ng dậy sớm, khoảng 5h30, ra hồ Ho&agrave;n Kiếm khi th&agrave;nh phố vẫn c&ograve;n ng&aacute;i ngủ. Tr&ecirc;n mặt hồ l&agrave; lớp sương mỏng, từng nh&oacute;m người tập dưỡng sinh, mấy cụ &ocirc;ng đ&aacute;nh cờ, tiếng chim r&iacute;u ran trong h&agrave;ng c&acirc;y&hellip; Chỉ đứng y&ecirc;n v&agrave;i ph&uacute;t th&ocirc;i m&agrave; cảm gi&aacute;c b&igrave;nh y&ecirc;n như thấm v&agrave;o da thịt.</p>\r\n\r\n<p>C&oacute; lần m&igrave;nh ngồi ở qu&aacute;n c&agrave; ph&ecirc; trong một con ng&otilde; nhỏ ở phố cổ. Qu&aacute;n cũ kỹ, b&agrave;n ghế gỗ mộc, ph&iacute;a trước l&agrave; cửa sổ nhỏ nh&igrave;n ra đường. Nh&igrave;n d&ograve;ng người hối hả, m&igrave;nh chợt nghĩ: H&agrave; Nội đẹp theo kiểu rất đời thường. Đẹp qua những ph&uacute;t tưởng như đơn giản nhất, nhưng khiến người ta nhớ m&atilde;i.</p>\r\n\r\n<p>Nhắc đến H&agrave; Nội m&agrave; bỏ qua ẩm thực th&igrave; thật c&oacute; lỗi với c&aacute;i bụng. B&uacute;n chả thơm lừng, phở n&oacute;ng hổi, b&uacute;n thang tinh tế hay m&oacute;n x&ocirc;i x&eacute;o với m&agrave;u v&agrave;ng bắt mắt đều l&agrave; những m&oacute;n ăn trọn vẹn hương vị thủ đ&ocirc;. Thỉnh thoảng m&igrave;nh c&ograve;n chui v&agrave;o những qu&aacute;n nhỏ x&iacute;u trong ng&otilde;, t&igrave;m m&oacute;n qu&agrave; vặt như b&aacute;nh r&aacute;n mật, ch&egrave; đỗ đen&hellip; ngon đến mức phải ăn hai lần trong ng&agrave;y.</p>\r\n\r\n<p>Tối đến, H&agrave; Nội kho&aacute;c l&ecirc;n m&igrave;nh một vẻ đẹp ho&agrave;n to&agrave;n kh&aacute;c: lung linh, sầm uất nhưng kh&ocirc;ng mất đi n&eacute;t cổ k&iacute;nh. Tạ Hiện đ&ocirc;ng vui, Nh&agrave; Thờ rộn r&agrave;ng tiếng tr&ograve; chuyện, nhưng chỉ cần đi th&ecirc;m v&agrave;i bước l&agrave; lại gặp một con phố y&ecirc;n tĩnh đến lạ.</p>\r\n\r\n<p>H&agrave; Nội kh&ocirc;ng chỉnh chu, kh&ocirc;ng ho&agrave;n hảo, nhưng H&agrave; Nội thật. V&agrave; đ&ocirc;i khi, ch&iacute;nh những thứ thật ấy lại khiến người ta thương.</p>\r\n', 1, 'assets/images/posts/post_691d3e0a10b9a.jpg', '2025-11-22 01:21:23'),
(2, 'SAPA: GIỮA BIỂN MÂY VÀ NÚI ĐỒI, TÌM LẠI MỘT BẢN THÂN BÌNH YÊN HƠN', '<p>Người ta thường n&oacute;i Sapa l&agrave; &ldquo;thị trấn trong sương&rdquo;, nhưng với m&igrave;nh, Sapa c&ograve;n l&agrave; điểm hẹn của những t&acirc;m hồn cần một khoảng nghỉ. Mỗi lần đến đ&acirc;y, m&igrave;nh như qu&ecirc;n đi những lo toan thường nhật, để t&acirc;m tr&iacute; được thả lỏng giữa n&uacute;i trời h&ugrave;ng vĩ.</p>\r\n\r\n<p>Buổi s&aacute;ng Sapa se lạnh ngay cả giữa m&ugrave;a h&egrave;. Mở mắt ra l&agrave; thấy sương phủ trắng những m&aacute;i nh&agrave;, bước ra ban c&ocirc;ng l&agrave; biển m&acirc;y bồng bềnh ngay trước mặt. Nếu ở đ&uacute;ng ng&agrave;y thời tiết đẹp, bạn c&ograve;n nh&igrave;n thấy cả mặt trời dần l&oacute; dạng ph&iacute;a sau những đỉnh n&uacute;i &ndash; khoảnh khắc ấy đẹp đến mức m&igrave;nh chỉ biết lặng người.</p>\r\n\r\n<p>M&igrave;nh từng c&oacute; h&agrave;nh tr&igrave;nh trekking bản C&aacute;t C&aacute;t d&agrave;i gần 4 tiếng. Đường kh&ocirc;ng qu&aacute; kh&oacute; nhưng đ&ograve;i hỏi ch&uacute;t ki&ecirc;n nhẫn. B&ugrave; lại, cảnh dọc đường đẹp mơ hồ: ruộng bậc thang tầng tầng lớp lớp, những chiếc cối xay nước quay đều, tiếng suối r&oacute;c r&aacute;ch v&agrave; v&agrave;i ch&uacute; b&eacute; người M&ocirc;ng chạy tung tăng. C&oacute; một b&eacute; g&aacute;i dừng lại hỏi m&igrave;nh: &ldquo;Chị mệt kh&ocirc;ng?&rdquo; bằng giọng lơ lớ rất dễ thương. Trong khoảnh khắc nhỏ ấy, m&igrave;nh cảm nhận r&otilde; sự hồn hậu của con người v&ugrave;ng cao.</p>\r\n\r\n<p>Đi Fansipan cũng l&agrave; trải nghiệm kh&ocirc;ng thể bỏ lỡ. Khi c&aacute;p treo đưa bạn l&ecirc;n cao dần, thế giới như thay đổi ngay trước mắt. Từ xanh của n&uacute;i rừng, trắng của m&acirc;y, đến c&aacute;i lạnh buốt khi đặt ch&acirc;n xuống đỉnh &ndash; mọi thứ tạo n&ecirc;n cảm gi&aacute;c rất &ldquo;đ&atilde;&rdquo;.</p>\r\n\r\n<p>Tối đến, Sapa kh&ocirc;ng buồn như nhiều người nghĩ. Quảng trường nhộn nhịp, m&ugrave;i thịt nướng thơm lừng, những người b&aacute;n h&agrave;ng rong m&ecirc; đắm trong điệu kh&egrave;n &ndash; tất cả tạo n&ecirc;n một Sapa rực rỡ m&agrave; ấm &aacute;p.</p>\r\n\r\n<p>Sapa l&agrave; nơi khiến bạn muốn ở l&acirc;u hơn một ch&uacute;t. Muốn thức dậy giữa sương m&ugrave; th&ecirc;m một ng&agrave;y. Muốn nghe tiếng n&uacute;i rừng thở nhẹ th&ecirc;m một lần nữa.</p>\r\n', 1, 'assets/images/posts/post_691d3ded0dca9.jpg', '2025-11-22 01:24:23'),
(3, 'HỘI AN: TIẾP XÚC VỚI SỰ BÌNH YÊN NGUYÊN BẢN GIỮA PHỐ CỔ', '<p>Nếu phải chọn một nơi ở Việt Nam m&agrave; m&igrave;nh muốn sống v&agrave;i th&aacute;ng để viết l&aacute;ch, kh&ocirc;ng do dự, m&igrave;nh sẽ chọn Hội An. Nơi n&agrave;y c&oacute; một điều g&igrave; đ&oacute; rất dịu d&agrave;ng: &aacute;nh nắng v&agrave;ng như mật, những bức tường cổ nhuốm m&agrave;u thời gian, những chiếc đ&egrave;n lồng rực rỡ mỗi khi chiều xuống.</p>\r\n\r\n<p>Buổi chiều ở Hội An đẹp đến nao l&ograve;ng. &Aacute;nh nắng xi&ecirc;n qua những &ocirc; cửa nhỏ, hắt l&ecirc;n tường v&agrave;ng cũ kỹ, khiến mọi thứ trở n&ecirc;n mềm mại v&agrave; đầy ho&agrave;i niệm. M&igrave;nh th&iacute;ch lang thang kh&ocirc;ng mục đ&iacute;ch, đi từ con phố n&agrave;y sang con phố kh&aacute;c, gh&eacute; v&agrave;o tiệm tạp h&oacute;a nhỏ xinh chỉ để mua một chai nước rồi tr&ograve; chuyện c&ugrave;ng c&ocirc; chủ qu&aacute;n th&acirc;n thiện.</p>\r\n\r\n<p>Hội An c&ograve;n khiến m&igrave;nh nhớ bởi &acirc;m thanh: tiếng guốc g&otilde; nhẹ tr&ecirc;n đường, tiếng m&aacute;i ch&egrave;o khua nước tr&ecirc;n s&ocirc;ng Ho&agrave;i, tiếng người b&aacute;n h&agrave;ng gọi nhau th&acirc;n mật&hellip; Tất cả h&ograve;a v&agrave;o nhau tạo th&agrave;nh một bản nhạc rất ri&ecirc;ng, rất Hội An.</p>\r\n\r\n<p>Ẩm thực th&igrave; qu&aacute; tuyệt vời: cao lầu dai ngon, m&igrave; Quảng chuẩn vị, cơm g&agrave; thơm phức, b&aacute;nh m&igrave; Hội An th&igrave; khỏi phải b&agrave;n &ndash; ăn một lần l&agrave; ghiền. Tối đến, ch&egrave; m&egrave; đen n&oacute;ng hổi l&agrave; m&oacute;n khiến tim m&igrave;nh ấm l&ecirc;n giữa kh&ocirc;ng kh&iacute; m&aacute;t mẻ.</p>\r\n\r\n<p>Khoảnh khắc đẹp nhất ở Hội An c&oacute; lẽ l&agrave; cảnh thả hoa đăng. Ngồi tr&ecirc;n thuyền tr&ocirc;i nhẹ giữa d&ograve;ng, &aacute;nh đ&egrave;n lồng lung linh xung quanh, người l&aacute;i thuyền kể v&agrave;i c&acirc;u chuyện nhỏ&hellip; mọi thứ tạo cảm gi&aacute;c b&igrave;nh y&ecirc;n đến lạ.</p>\r\n\r\n<p>Hội An kh&ocirc;ng ồn &atilde;, kh&ocirc;ng vội v&atilde;. N&oacute; như một trang s&aacute;ch cũ, chỉ cần mở ra l&agrave; thấy ngan ng&aacute;t hương của k&yacute; ức.</p>\r\n', 1, 'assets/images/posts/post_691d3ee5e896b.jpg', '2025-11-22 01:26:26'),
(4, 'HUẾ: THÀNH PHỐ CỦA MƯA, CỦA SỰ TRẦM MẶC VÀ VẺ ĐẸP TINH TẾ', '<p>Huế l&agrave; nơi đầu ti&ecirc;n khiến m&igrave;nh nhận ra rằng sự lặng lẽ cũng c&oacute; vẻ đẹp ri&ecirc;ng của n&oacute;. Nếu H&agrave; Nội khiến người ta thương bằng sự nhộn nhịp đời thường, th&igrave; Huế lại chạm v&agrave;o tim bằng những điều rất khẽ &ndash; tiếng mưa rơi lộp bộp tr&ecirc;n m&aacute;i ng&oacute;i, nhịp thở chậm r&atilde;i của s&ocirc;ng Hương, những con đường rợp b&oacute;ng c&acirc;y im ắng đến nhẹ cả t&acirc;m hồn.</p>\r\n\r\n<p>Lần đầu m&igrave;nh đến Huế l&agrave; v&agrave;o một ng&agrave;y mưa nhẹ. Mưa Huế kh&ocirc;ng vội v&atilde;, kh&ocirc;ng dữ dội m&agrave; chỉ rơi rất khẽ, như muốn giữ ch&acirc;n người lữ kh&aacute;ch ở lại. M&igrave;nh gh&eacute; Đại Nội trong một buổi s&aacute;ng &acirc;m u, nh&igrave;n những bức tường r&ecirc;u phong, những m&aacute;i điện v&agrave;ng &oacute;ng, v&agrave; những hoa văn tinh xảo vẫn c&ograve;n được giữ nguy&ecirc;n vẹn. Cảm gi&aacute;c như cả qu&aacute; khứ đang chầm chậm mở ra trước mắt.</p>\r\n\r\n<p>Buổi chiều, m&igrave;nh đi thuyền tr&ecirc;n s&ocirc;ng Hương. Gi&oacute; m&aacute;t lạnh, mặt nước phẳng lặng, xa xa l&agrave; cầu Trường Tiền. Ở khoảnh khắc ấy, m&igrave;nh hiểu v&igrave; sao người ta n&oacute;i Huế buồn. Nhưng đ&oacute; kh&ocirc;ng phải nỗi buồn mệt mỏi, m&agrave; l&agrave; cảm gi&aacute;c trầm tĩnh, s&acirc;u lắng, khiến người ta như được chữa l&agrave;nh.</p>\r\n\r\n<p>Ẩm thực Huế cũng tinh tế như ch&iacute;nh con người nơi đ&acirc;y. B&uacute;n b&ograve; Huế đậm đ&agrave;, cơm hến mộc mạc, b&aacute;nh b&egrave;o &ndash; nậm &ndash; lọc nhỏ xinh nhưng đầy hương vị. Mỗi m&oacute;n ăn đều mang theo sự cầu kỳ, cẩn trọng, như thể người nấu gửi gắm cả t&acirc;m t&igrave;nh của m&igrave;nh v&agrave;o từng hạt gạo.</p>\r\n\r\n<p>Buổi tối ở Huế, m&igrave;nh đi bộ dọc những con đường vắng, nghe tiếng ve gọi h&egrave; v&agrave; tiếng bước ch&acirc;n của ch&iacute;nh m&igrave;nh. Một th&agrave;nh phố đẹp theo c&aacute;ch kh&ocirc;ng ồn &agrave;o, kh&ocirc;ng ph&ocirc; trương. V&agrave; ch&iacute;nh điều đ&oacute; khiến m&igrave;nh lu&ocirc;n nhớ m&atilde;i.</p>\r\n', 1, 'assets/images/posts/post_691d3f4ea6d87.jpg', '2025-11-22 01:28:27'),
(5, 'ĐÀ NẴNG: THÀNH PHỐ NĂNG ĐỘNG NHƯNG CHẲNG KÉM PHẦN ẤM ÁP', '<p>Đ&agrave; Nẵng lu&ocirc;n mang đến cho m&igrave;nh một cảm gi&aacute;c rất đặc biệt: hiện đại nhưng kh&ocirc;ng bon chen, s&ocirc;i động nhưng vẫn giữ được sự th&acirc;n thiện hiếm thấy. Đ&acirc;y l&agrave; th&agrave;nh phố m&agrave; bạn c&oacute; thể thoải m&aacute;i &ldquo;sống hết m&igrave;nh&rdquo; nhưng vẫn t&igrave;m được những khoảng lặng để c&acirc;n bằng.</p>\r\n\r\n<p>Biển Mỹ Kh&ecirc; l&agrave; nơi m&igrave;nh lu&ocirc;n d&agrave;nh &iacute;t nhất một buổi s&aacute;ng để ngắm b&igrave;nh minh. M&agrave;u trời loang dần từ t&iacute;m sang hồng, s&oacute;ng biển vỗ nh&egrave; nhẹ v&agrave; tiếng người tập thể dục từ xa vọng lại &ndash; cảm gi&aacute;c như cả thế giới đang bắt đầu một ng&agrave;y mới đầy hy vọng. M&igrave;nh từng ngồi h&agrave;ng giờ chỉ để nghe tiếng s&oacute;ng v&agrave; thở thật s&acirc;u.</p>\r\n\r\n<p>Đ&agrave; Nẵng c&ograve;n c&oacute; B&agrave; N&agrave; Hills với khung cảnh như trời &Acirc;u. D&ugrave; đi nhiều lần nhưng cứ mỗi lần đặt ch&acirc;n l&ecirc;n Cầu V&agrave;ng, m&igrave;nh lại thấy cho&aacute;ng ngợp trước sự s&aacute;ng tạo của con người. Những &ldquo;b&agrave;n tay đ&aacute;&rdquo; khổng lồ &ocirc;m lấy c&acirc;y cầu uốn lượn giữa lưng chừng trời khiến nơi n&agrave;y trở th&agrave;nh biểu tượng kh&ocirc;ng thể thay thế.</p>\r\n\r\n<p>Nếu bạn th&iacute;ch sự y&ecirc;n b&igrave;nh, b&aacute;n đảo Sơn Tr&agrave; l&agrave; lựa chọn tuyệt vời. Đường uốn lượn quanh n&uacute;i, một b&ecirc;n l&agrave; biển xanh thẳm, một b&ecirc;n l&agrave; rừng nguy&ecirc;n sinh. Ngắm Voọc Ch&agrave; V&aacute; hay đứng ở Linh Ứng nh&igrave;n xuống th&agrave;nh phố l&agrave; những trải nghiệm cực kỳ đ&aacute;ng nhớ.</p>\r\n\r\n<p>Ẩm thực Đ&agrave; Nẵng cũng khiến m&igrave;nh m&ecirc; mẩn: m&igrave; Quảng si&ecirc;u ngon, hải sản tươi r&oacute;i, b&aacute;nh tr&aacute;ng cuốn thịt heo đậm vị. Con người nơi đ&acirc;y dễ gần, hiếu kh&aacute;ch v&agrave; rất ch&acirc;n th&agrave;nh.</p>\r\n\r\n<p>Một th&agrave;nh phố khiến người ta cảm thấy như được ch&agrave;o đ&oacute;n &ndash; đ&oacute; ch&iacute;nh l&agrave; Đ&agrave; Nẵng.</p>\r\n', 1, 'assets/images/posts/post_691d45cba39d3.jpg', '2025-11-22 01:30:31'),
(6, 'NHA TRANG: THIÊN ĐƯỜNG BIỂN XANH VÀ NHỮNG DẢI CÁT DÀI BẤT TẬN', '<p>Nha Trang l&agrave; một trong những nơi khiến m&igrave;nh chỉ muốn&hellip; nhảy ngay xuống biển khi vừa đến nơi. M&agrave;u nước xanh trong bất ngờ, trời nắng nhẹ v&agrave; kh&ocirc;ng kh&iacute; trong l&agrave;nh l&agrave;m m&igrave;nh thấy như đ&atilde; rời xa mọi &aacute;p lực của cuộc sống.</p>\r\n\r\n<p>S&aacute;ng Nha Trang rất đẹp &ndash; biển lấp l&aacute;nh &aacute;nh v&agrave;ng dưới nắng, những chiếc thuyền đ&aacute;nh c&aacute; trở về mang theo th&agrave;nh quả của một đ&ecirc;m d&agrave;i. M&igrave;nh từng đi dạo dọc bờ biển l&uacute;c 5h30, v&ocirc; t&igrave;nh thấy cảnh người d&acirc;n tập thể dục v&agrave; trẻ con n&ocirc; đ&ugrave;a trong tiếng s&oacute;ng. Một cảm gi&aacute;c b&igrave;nh y&ecirc;n hiếm c&oacute; giữa th&agrave;nh phố s&ocirc;i động.</p>\r\n\r\n<p>Trải nghiệm đ&aacute;ng nhớ nhất của m&igrave;nh ở Nha Trang l&agrave; lặn ngắm san h&ocirc; tại H&ograve;n Mun. Khi &uacute;p mặt xuống nước, một thế giới ho&agrave;n to&agrave;n kh&aacute;c hiện ra: những rặng san h&ocirc; đầy m&agrave;u sắc, đ&agrave;n c&aacute; bơi lội tung tăng v&agrave; &aacute;nh nắng xuy&ecirc;n qua mặt biển lung linh như tranh vẽ. Đ&oacute; l&agrave; khoảnh khắc khiến m&igrave;nh nhận ra thi&ecirc;n nhi&ecirc;n đẹp đến nhường n&agrave;o.</p>\r\n\r\n<p>Ẩm thực Nha Trang th&igrave; m&ecirc; ly: b&uacute;n c&aacute;, b&aacute;nh căn, nem nướng, hải sản đủ loại&hellip; Gi&aacute; cả phải chăng, m&agrave; độ tươi th&igrave; khỏi ch&ecirc;. Buổi tối dạo quanh khu chợ đ&ecirc;m, m&igrave;nh ăn no đến mức&hellip; đi kh&ocirc;ng nổi.</p>\r\n\r\n<p>Nha Trang l&agrave; nơi m&igrave;nh muốn đến mỗi khi cần vitamin-sea đ&uacute;ng nghĩa: trời xanh &ndash; biển đẹp &ndash; đồ ăn ngon.</p>\r\n', 1, 'assets/images/posts/post_691d47161a0e8.jpg', '2025-11-22 01:32:02'),
(7, 'PHÚ QUỐC: HÒN ĐẢO NGỌC VỚI HOÀNG HÔN ĐẸP NHẤT VIỆT NAM', '<p>Ph&uacute; Quốc l&agrave; nơi m&igrave;nh tin rằng: &ldquo;Ai một lần đến rồi cũng muốn quay lại.&rdquo; Kh&ocirc;ng phải v&igrave; sang hay v&igrave; hiện đại, m&agrave; v&igrave; vẻ đẹp hoang sơ xen lẫn sự tiện nghi đủ khiến chuyến đi trọn vẹn.</p>\r\n\r\n<p>Điều khiến m&igrave;nh nhớ nhất ch&iacute;nh l&agrave; ho&agrave;ng h&ocirc;n. B&atilde;i Sao, Sunset Sanato hay Ocsen Beach Bar &ndash; mỗi nơi lại mang một vẻ đẹp ri&ecirc;ng. Nh&igrave;n mặt trời từ từ ch&igrave;m xuống biển, sắc v&agrave;ng rồi cam rồi t&iacute;m loang khắp bầu trời&hellip; khoảnh khắc ấy thật sự khiến tim m&igrave;nh mềm lại.</p>\r\n\r\n<p>M&igrave;nh từng thu&ecirc; xe m&aacute;y chạy từ Bắc đến Nam đảo trong một ng&agrave;y. Qua những con đường rợp b&oacute;ng c&acirc;y, qua những l&agrave;ng ch&agrave;i nhỏ xinh, qua những b&atilde;i biển vắng người đến mức nghe r&otilde; tiếng gi&oacute;. Ngư d&acirc;n ở đ&acirc;y rất th&acirc;n thiện, m&igrave;nh gh&eacute; một qu&aacute;n nhỏ b&ecirc;n đường ăn cơm, c&ocirc; ch&uacute; chủ qu&aacute;n hỏi han như quen từ l&acirc;u.</p>\r\n\r\n<p>Nhắc đến Ph&uacute; Quốc th&igrave; kh&ocirc;ng thể bỏ qua c&aacute;c trải nghiệm như: đi c&aacute;p treo vượt biển H&ograve;n Thơm, thăm VinWonders &ndash; Safari, h&ograve;a m&igrave;nh v&agrave;o những khu chợ địa phương v&agrave; thử m&oacute;n gỏi c&aacute; tr&iacute;ch trứ danh.</p>\r\n\r\n<p>Đ&ecirc;m ở Ph&uacute; Quốc, m&igrave;nh ngồi tr&ecirc;n b&atilde;i biển, nghe s&oacute;ng vỗ nhẹ v&agrave; ngửi m&ugrave;i gi&oacute; biển mằn mặn. Một cảm gi&aacute;c tự do đến kỳ lạ.</p>\r\n', 1, 'assets/images/posts/post_691d479e9d110.jpg', '2025-11-22 01:33:18'),
(8, 'NINH BÌNH: HÙNG VĨ NHƯ MỘT BỨC TRANH THỦY MẶC', '<p>Mỗi lần nhắc đến Ninh B&igrave;nh l&agrave; m&igrave;nh lại nhớ ngay đến cảm gi&aacute;c cho&aacute;ng ngợp khi đứng trước Hang M&uacute;a. Leo gần 500 bậc thang, mệt th&igrave; mệt thật nhưng khi l&ecirc;n đến đỉnh, nh&igrave;n to&agrave;n bộ Tam Cốc xanh mướt dưới ch&acirc;n th&igrave; mọi mệt mỏi đều tan biến.</p>\r\n\r\n<p>Ninh B&igrave;nh mang vẻ đẹp rất &ldquo;điện ảnh&rdquo;. Tr&agrave;ng An nước trong như gương, hai b&ecirc;n l&agrave; n&uacute;i đ&aacute; v&ocirc;i cao ch&oacute;t v&oacute;t, thuyền đi chầm chậm xuy&ecirc;n qua hang động d&agrave;i tối om rồi lại mở ra một khung cảnh s&aacute;ng bừng đầy thơ mộng. M&igrave;nh chỉ biết ngồi im, ngắm mọi thứ tr&ocirc;i qua trước mắt như một thước phim cổ trang.</p>\r\n\r\n<p>M&igrave;nh cũng th&iacute;ch ch&ugrave;a B&aacute;i Đ&iacute;nh &ndash; một quần thể kiến tr&uacute;c rộng lớn v&agrave; uy nghi. Đi bộ ở đ&acirc;y gi&uacute;p t&acirc;m m&igrave;nh lắng lại, bước ch&acirc;n nhẹ hơn, hơi thở s&acirc;u hơn.</p>\r\n\r\n<p>Ẩm thực Ninh B&igrave;nh c&oacute; cơm ch&aacute;y &ndash; d&ecirc; n&uacute;i, nghe đơn giản nhưng ăn rất ngon. Đặc biệt l&agrave; phần thịt d&ecirc; dai ngọt, chấm với nước sốt n&oacute;ng hổi đ&uacute;ng l&agrave; &ldquo;đỉnh cao&rdquo;.</p>\r\n\r\n<p>Ninh B&igrave;nh kh&ocirc;ng ồn &agrave;o, kh&ocirc;ng ph&ocirc; trương. Nhưng ch&iacute;nh sự đồ sộ v&agrave; thi&ecirc;n nhi&ecirc;n xanh ng&aacute;t lại khiến người ta dễ say m&ecirc;.</p>\r\n', 1, 'assets/images/posts/post_691d4813ce9da.jpg', '2025-11-22 01:35:15'),
(9, 'ĐÀ LẠT: NƠI NHỮNG ĐÁM SƯƠNG CỨ MUỐN QUẤN LẤY VAI NGƯỜI', '<p>Đ&agrave; Lạt l&agrave; th&agrave;nh phố của những kẻ mộng mơ &ndash; v&agrave; m&igrave;nh nằm trong số đ&oacute;. Ở đ&acirc;y, người ta dễ mềm l&ograve;ng, dễ y&ecirc;u, dễ cảm, v&agrave; cũng dễ t&igrave;m lại ch&iacute;nh m&igrave;nh.</p>\r\n\r\n<p>Buổi s&aacute;ng Đ&agrave; Lạt lạnh se, mở cửa ra thấy sương phủ k&iacute;n khung cảnh trước mắt, cảm gi&aacute;c như đang lạc v&agrave;o một bộ phim l&atilde;ng mạn. M&igrave;nh th&iacute;ch ngồi trong qu&aacute;n c&agrave; ph&ecirc; nhỏ, nghe nhạc indie, h&iacute;t h&agrave; m&ugrave;i b&aacute;nh nướng v&agrave; nh&igrave;n m&acirc;y lững lờ tr&ocirc;i tr&ecirc;n những ngọn đồi.</p>\r\n\r\n<p>Đ&agrave; Lạt c&oacute; rất nhiều nơi đẹp: đồi ch&egrave; Cầu Đất, hồ Tuyền L&acirc;m, đỉnh Langbiang, những con dốc quanh co v&agrave; vườn hoa rực rỡ. Nhưng điều khiến m&igrave;nh nhớ nhất lại l&agrave;&hellip; c&aacute;i lạnh. C&aacute;i lạnh khiến người ta muốn nắm tay nhau, muốn uống một ly cacao n&oacute;ng v&agrave; muốn t&acirc;m sự nhiều hơn.</p>\r\n\r\n<p>Ẩm thực Đ&agrave; Lạt cũng rất đ&aacute;ng để trải nghiệm: lẩu g&agrave; l&aacute; &eacute; cay ấm, b&aacute;nh ướt l&ograve;ng g&agrave; ngon &ldquo;đi&ecirc;u đứng&rdquo;, sữa đậu n&agrave;nh n&oacute;ng mỗi tối. Đi chợ đ&ecirc;m ăn vặt cũng vui, đặc biệt l&agrave; khoai lang nướng v&agrave; b&aacute;nh tr&aacute;ng nướng &ndash; m&oacute;n &ldquo;pizza Đ&agrave; Lạt&rdquo; nổi tiếng.</p>\r\n\r\n<p>Đ&agrave; Lạt đẹp kh&ocirc;ng phải v&igrave; ho&agrave;n hảo, m&agrave; v&igrave; n&oacute; c&oacute; một ch&uacute;t ho&agrave;i niệm, một ch&uacute;t buồn, một ch&uacute;t thơ, khiến ai đến rồi cũng thấy l&ograve;ng nhẹ t&ecirc;nh.</p>\r\n', 1, 'assets/images/posts/post_691d485c3dd16.jpg', '2025-11-22 01:37:28'),
(10, 'QUY NHƠN: THIÊN NHIÊN TRONG TRẺO VÀ BIỂN ĐẸP ĐẾN NGỠ NGÀNG', '<p>Quy Nhơn l&agrave; một trong những nơi khiến m&igrave;nh cảm thấy như đang kh&aacute;m ph&aacute; ra một &ldquo;vi&ecirc;n ngọc th&ocirc;&rdquo;. Biển xanh, c&aacute;t trắng, nắng v&agrave;ng &ndash; tất cả đều đẹp theo c&aacute;ch rất tự nhi&ecirc;n, kh&ocirc;ng cần chỉnh sửa hay t&ocirc; điểm.</p>\r\n\r\n<p>Eo Gi&oacute; l&agrave; nơi m&igrave;nh đến đầu ti&ecirc;n. Đứng tr&ecirc;n cao nh&igrave;n xuống, từng con s&oacute;ng đập v&agrave;o v&aacute;ch đ&aacute; trắng x&oacute;a, gi&oacute; thổi mạnh đến mức t&oacute;c bay tứ tung, nhưng ch&iacute;nh khoảnh khắc ấy lại khiến m&igrave;nh thấy cực kỳ sống động. Cảnh đẹp ở đ&acirc;y kh&ocirc;ng l&atilde;ng mạn kiểu Đ&agrave; Lạt hay quyến rũ như Ph&uacute; Quốc, m&agrave; l&agrave; vẻ đẹp hoang sơ v&agrave; mạnh mẽ.</p>\r\n\r\n<p>Kỳ Co th&igrave; ngược lại &ndash; hiền h&ograve;a v&agrave; trong trẻo. Nước xanh như m&agrave;u ngọc, nh&igrave;n tận đ&aacute;y. M&igrave;nh từng đi bộ dưới l&agrave;n nước m&aacute;t, cảm gi&aacute;c như ch&acirc;n chạm v&agrave;o từng vi&ecirc;n đ&aacute; nhỏ x&iacute;u dưới s&agrave;n biển.</p>\r\n\r\n<p>Ẩm thực Quy Nhơn giản dị nhưng rất ngon: b&aacute;nh x&egrave;o t&ocirc;m nhảy, b&uacute;n chả c&aacute;, ch&egrave; đậu đỏ cốt dừa. Hải sản cực kỳ tươi nhưng gi&aacute; lại kh&aacute; mềm, ăn thả ga kh&ocirc;ng lo &ldquo;đau v&iacute;&rdquo;.</p>\r\n\r\n<p>Quy Nhơn l&agrave; nơi để bạn trốn khỏi sự x&ocirc; bồ v&agrave; cảm nhận thi&ecirc;n nhi&ecirc;n theo c&aacute;ch nguy&ecirc;n bản nhất.</p>\r\n', 1, 'assets/images/posts/post_691d48b485479.jpg', '2025-11-22 01:38:56'),
(11, 'PHÚ YÊN: XỨ SỞ HOA VÀNG CỎ XANH NHẸ NHÀNG NHƯ THƠ', '<p>Ph&uacute; Y&ecirc;n khiến m&igrave;nh li&ecirc;n tưởng đến những b&agrave;i thơ của tuổi trẻ &ndash; trong trẻo, nhẹ nh&agrave;ng v&agrave; c&oacute; ch&uacute;t g&igrave; đ&oacute; y&ecirc;n b&igrave;nh đến lạ.</p>\r\n\r\n<p>G&agrave;nh Đ&aacute; Dĩa l&agrave; nơi m&igrave;nh ấn tượng nhất. Những phiến đ&aacute; xếp chồng l&ecirc;n nhau như b&agrave;n tay của tạo h&oacute;a, m&agrave;u đen &oacute;ng dưới nắng khiến m&igrave;nh chỉ biết &ldquo;wow&rdquo; li&ecirc;n tục.</p>\r\n\r\n<p>M&igrave;nh cũng th&iacute;ch Mũi Điện &ndash; nơi đ&oacute;n b&igrave;nh minh đầu ti&ecirc;n của Việt Nam. Trải nghiệm đứng tr&ecirc;n mỏm đ&aacute;, nh&igrave;n mặt trời từ từ nh&uacute; l&ecirc;n khỏi mặt biển, nghe tiếng s&oacute;ng vỗ ầm &agrave;o&hellip; l&agrave; thứ khiến m&igrave;nh nhớ m&atilde;i.</p>\r\n\r\n<p>Ph&uacute; Y&ecirc;n kh&ocirc;ng đ&ocirc;ng đ&uacute;c như Nha Trang, kh&ocirc;ng n&aacute;o nhiệt như Đ&agrave; Nẵng, nhưng ch&iacute;nh sự vắng vẻ ấy lại tạo n&ecirc;n n&eacute;t cuốn h&uacute;t ri&ecirc;ng. Người d&acirc;n dễ thương, th&acirc;n thiện, đồ ăn ngon &ndash; nhất l&agrave; mắt c&aacute; ngừ đại dương v&agrave; b&aacute;nh canh hẹ.</p>\r\n\r\n<p>Nếu bạn cần một nơi để &ldquo;sống chậm&rdquo;, Ph&uacute; Y&ecirc;n l&agrave; lựa chọn tuyệt vời.</p>\r\n', 1, 'assets/images/posts/post_691d4909f05c7.jpg', '2025-11-22 01:40:21'),
(12, 'CẦN THƠ: MIỀN TÂY CHÂN CHẤT VÀ NHỮNG BUỔI SÁNG BÌNH YÊN TRÊN CHỢ NỔI', '<p>Cần Thơ l&agrave; v&ugrave;ng đất khiến m&igrave;nh cảm thấy gần gũi ngay từ lần đầu ti&ecirc;n. Kh&ocirc;ng chỉ v&igrave; cảnh đẹp m&agrave; c&ograve;n v&igrave; con người nơi đ&acirc;y &ndash; ch&acirc;n chất, mộc mạc v&agrave; cực kỳ hiếu kh&aacute;ch.</p>\r\n\r\n<p>Đi chợ nổi C&aacute;i Răng v&agrave;o s&aacute;ng sớm l&agrave; trải nghiệm kh&ocirc;ng thể bỏ lỡ. Trời c&ograve;n mờ sương, những chiếc ghe lớn nhỏ đ&atilde; tấp nập. Người b&aacute;n người mua n&oacute;i chuyện r&ocirc;m rả, tiếng m&aacute;y nổ, tiếng nước vỗ&hellip; tất cả tạo th&agrave;nh một nhịp điệu rất miền T&acirc;y. M&igrave;nh ăn t&ocirc; hủ tiếu n&oacute;ng hổi ngay tr&ecirc;n ghe &ndash; đơn giản nhưng ngon lạ thường.</p>\r\n\r\n<p>Buổi chiều, m&igrave;nh th&iacute;ch đi dạo bến Ninh Kiều, ngắm s&ocirc;ng Hậu lững lờ tr&ocirc;i v&agrave; nghe gi&oacute; thổi m&aacute;t rượi. Con người miền T&acirc;y lu&ocirc;n để lại cho m&igrave;nh cảm gi&aacute;c dễ chịu &ndash; gặp ai cũng cười, cũng ch&agrave;o hỏi vui vẻ.</p>\r\n\r\n<p>Ẩm thực miền T&acirc;y th&igrave; khỏi phải b&agrave;n: lẩu mắm, c&aacute; linh b&ocirc;ng đi&ecirc;n điển, chuối nếp nướng, b&aacute;nh x&egrave;o miền T&acirc;y&hellip; mỗi m&oacute;n đều đậm đ&agrave; v&agrave; h&agrave;o sảng như ch&iacute;nh con người nơi đ&acirc;y.</p>\r\n\r\n<p>Cần Thơ l&agrave; nơi khiến m&igrave;nh nhớ bởi sự ấm &aacute;p của t&igrave;nh người.</p>\r\n', 1, 'assets/images/posts/post_691d4975af8f0.jpg', '2025-11-22 01:42:09'),
(13, 'SƠN ĐOÒNG: GIẤC MƠ LỚN CỦA NHỮNG KẺ YÊU KHÁM PHÁ', '<p>Nếu c&oacute; nơi n&agrave;o ở Việt Nam khiến m&igrave;nh cảm thấy nhỏ b&eacute; trước thi&ecirc;n nhi&ecirc;n, th&igrave; đ&oacute; chắc chắn l&agrave; Sơn Đo&ograve;ng. Đ&acirc;y kh&ocirc;ng chỉ l&agrave; một điểm đến, m&agrave; l&agrave; một h&agrave;nh tr&igrave;nh &ndash; h&agrave;nh tr&igrave;nh vượt qua ch&iacute;nh m&igrave;nh để được chạm v&agrave;o sự kỳ vĩ nhất của tạo h&oacute;a.</p>\r\n\r\n<p>Chuyến trekking nhiều ng&agrave;y, băng qua rừng s&acirc;u, vượt suối, leo dốc, lội b&ugrave;n&hellip; l&agrave; thử th&aacute;ch kh&ocirc;ng nhỏ. Nhưng khi đặt ch&acirc;n v&agrave;o l&ograve;ng hang, m&igrave;nh ho&agrave;n to&agrave;n chết lặng. Trần hang cao đến mức kh&ocirc;ng thể nh&igrave;n thấy đỉnh, những &ldquo;giếng trời&rdquo; khổng lồ để &aacute;nh s&aacute;ng chiếu v&agrave;o tạo n&ecirc;n một khung cảnh kh&ocirc;ng nơi n&agrave;o c&oacute; được.</p>\r\n\r\n<p>C&oacute; những khoảnh khắc m&igrave;nh chỉ biết đứng y&ecirc;n nh&igrave;n d&ograve;ng s&ocirc;ng ngầm chảy nhẹ, hay những khối thạch nhũ khổng lồ h&agrave;ng triệu năm tuổi. Đ&oacute; l&agrave; cảm gi&aacute;c vừa cho&aacute;ng ngợp, vừa biết ơn v&igrave; được thấy thi&ecirc;n nhi&ecirc;n đẹp đến vậy.</p>\r\n\r\n<p>Sơn Đo&ograve;ng kh&ocirc;ng d&agrave;nh cho tất cả mọi người, nhưng nếu bạn đ&atilde; y&ecirc;u kh&aacute;m ph&aacute;, đ&acirc;y ch&iacute;nh l&agrave; giấc mơ đ&aacute;ng để theo đuổi.</p>\r\n', 1, 'assets/images/posts/post_691d49c576d37.jpg', '2025-11-22 01:44:29'),
(14, 'MŨI NÉ: NƠI GẶP GỠ CỦA GIÓ, CÁT VÀ MẶT TRỜI', '<p>Mũi N&eacute; l&agrave; v&ugrave;ng đất đặc biệt &ndash; nơi m&agrave; gi&oacute; dường như thổi mạnh hơn, mặt trời rực rỡ hơn v&agrave; bầu trời xanh hơn mọi nơi kh&aacute;c.</p>\r\n\r\n<p>Đồi c&aacute;t bay l&agrave; nơi m&igrave;nh đến đầu ti&ecirc;n. Buổi s&aacute;ng nắng nhẹ, cả đồi c&aacute;t v&agrave;ng rực l&ecirc;n. Đi ch&acirc;n trần tr&ecirc;n c&aacute;t hơi n&oacute;ng n&oacute;ng, nhưng cảm gi&aacute;c ấy&hellip; đ&atilde; lắm! M&igrave;nh từng trượt c&aacute;t, t&eacute; l&ecirc;n t&eacute; xuống nhưng vui kh&ocirc;ng tưởng.</p>\r\n\r\n<p>Suối Ti&ecirc;n cũng l&agrave; nơi th&uacute; vị. D&ograve;ng nước đỏ cam chảy giữa hai v&aacute;ch đ&aacute;, đi bộ dưới suối m&aacute;t lạnh khiến m&igrave;nh thấy như đang đi trong một thế giới kh&aacute;c.</p>\r\n\r\n<p>M&igrave;nh c&ograve;n th&iacute;ch l&agrave;ng ch&agrave;i Mũi N&eacute; &ndash; nơi những con thuyền đầy m&agrave;u sắc neo đậu, m&ugrave;i biển mằn mặn h&ograve;a với gi&oacute;. Người d&acirc;n th&acirc;n thiện, sẵn s&agrave;ng kể chuyện biển cả chỉ trong v&agrave;i ph&uacute;t.</p>\r\n\r\n<p>Mũi N&eacute; l&agrave; nơi để tận hưởng nắng gi&oacute; v&agrave; cảm nhận sự ph&oacute;ng kho&aacute;ng.</p>\r\n', 1, 'assets/images/posts/post_691d4a1f61065.jpg', '2025-11-22 01:45:59'),
(15, 'HẠ LONG: BẢN GIAO HƯỞNG GIỮA BIỂN VÀ NÚI NON', '<p>Hạ Long l&agrave; nơi khiến m&igrave;nh cứ tưởng như đang đi giữa một bức tranh thuỷ mặc khổng lồ. H&agrave;ng ngh&igrave;n h&ograve;n đảo lớn nhỏ mọc l&ecirc;n giữa mặt biển xanh như ngọc, tạo n&ecirc;n một khung cảnh vừa kỳ vĩ vừa thơ mộng.</p>\r\n\r\n<p>Ngồi tr&ecirc;n thuyền, m&igrave;nh nh&igrave;n những d&atilde;y n&uacute;i đ&aacute; v&ocirc;i nối tiếp nhau, phản chiếu xuống mặt nước lấp l&aacute;nh. Thỉnh thoảng thuyền đi qua những hang động kỳ ảo với thạch nhũ lung linh &ndash; cảm gi&aacute;c như đang bước v&agrave;o thế giới huyền thoại.</p>\r\n\r\n<p>Nếu c&oacute; điều kiện, ngủ đ&ecirc;m tr&ecirc;n du thuyền l&agrave; trải nghiệm kh&ocirc;ng thể bỏ lỡ. Đ&ecirc;m xuống, biển y&ecirc;n ả, gi&oacute; m&aacute;t lạnh thổi qua từng khe cửa. M&igrave;nh nằm tr&ecirc;n boong t&agrave;u, nh&igrave;n bầu trời đầy sao m&agrave; cảm gi&aacute;c như cả thế giới đang nằm gọn trong l&ograve;ng b&agrave;n tay.</p>\r\n\r\n<p>Hạ Long kh&ocirc;ng chỉ đẹp &ndash; n&oacute; c&ograve;n khiến m&igrave;nh thấy tự h&agrave;o về thi&ecirc;n nhi&ecirc;n Việt Nam.</p>\r\n', 1, 'assets/images/posts/post_691d4a880ad96.jpg', '2025-11-22 01:47:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$OdhcWeim8vhptQPp8rjMnuNJqGHNb1eMaUzadnR72rEh.Cr3H.Rc2', 'admin', '2025-11-22 01:08:38'),
(2, 'Nguyễn Văn A', 'user@gmail.com', '$2y$10$OdhcWeim8vhptQPp8rjMnuNJqGHNb1eMaUzadnR72rEh.Cr3H.Rc2', 'user', '2025-11-22 01:09:07'),
(3, 'Nguyễn Văn B', 'user2@gmail.com', '$2y$10$1/1Oi.F1a0fGO7oPGlH3muIAPFl7xvsKyDnKj4Jbq0TuSkfJ3.SVW', 'user', '2025-11-22 01:10:06'),
(4, 'Nguyễn Văn C', 'user3@gmail.com', '$2y$10$vwDVqcaYzjPLrSCirENT6uf9NzgYv2jy3aOxkH.XkE1TNnTVGVo8e', 'user', '2025-11-22 01:11:27');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
