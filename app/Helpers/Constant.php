<?php

namespace App\Helpers;

class Constant {
    // common
    const TRUE_CONDITION = 'Y';
    const FALSE_CONDITION = 'N';
    const TRUE_CONDITION_NUMB = '1';
    const FALSE_CONDITION_NUMB = '0';
    const FORMAT_DATE_TIME = 'd-M-Y H:i';
    const ISO_FORMAT_DATE_TIME = 'D MMM YYYY HH:mm:ss';
    const MASK_CURRENCY = '#.##0';
    const MASK_PHONE = '000-0000-0000';
    const MAX_FILE_SIZE_LIMIT = 1000000; // 1 MB
    const MAX_FILE_MUSIC_SIZE_LIMIT = 3000000; // 3 MB
    // end common

    // role
    const ROLE_ADMIN = 'Admin';
    const ROLE_USER = 'User';
    // end role

    // rule
    const CODE_UNLIMITED = '~';
    const CODE_GMAPS = 'GMAPS';
    const CODE_MAX_GALLERY = 'MAXGALLERY';
    const CODE_CUSTOM_MUSIC = 'CUSTOMMUSIC';
    const CODE_MAX_STORY = 'MAXSTORY';
    const CODE_MAX_GUESTS = 'MAXGUESTS';

    const GMAPS_SAMPLE = true;
    const MAX_SAMPLE_GALLERY = 5;
    const MUSIC_CUSTOMABLE_SAMPLE = true;
    const MAX_SAMPLE_STORY = 10;
    const MAX_GREETING_DISPLAYED = 8;
    const MAX_GREETING_DISPLAYED_ON_DASHBOARD = 5;
    const MAX_FEEDBACK_DISPLAYED_ON_DASHBOARD = 5;
    const MAX_FEEDBACK_DISPLAYED_ON_LANDING_PAGE = 5;
    const MAX_INVOICE_PAYMENT_DISPLAYED_ON_DASHBOARD = 5;
    const MAX_POP_TEMPLATE_DISPLAYED_ON_DASHBOARD = 5;
    // end rule

    // app
    const ICON = 'favicon.ico';
    const LINK_HOW_TO_USE_APP = 'https://youtu.be/7tRlQYWWRIc';
    const COLOR_RED = 108;
    const COLOR_GREEN = 85;
    const COLOR_BLUE = 249;
    const CODE_MALE = 'L';
    const CODE_FEMALE = 'P';
    const PATH_INVITATION_VIEW = 'invitation';
    const PATH_INVITATION_ERROR_VIEW = 'invitation.error.index';
    const CODE_WEDDING = 'Wedding';
    const CODE_BANK_FUNC_CATEGORY_PAYMENT = 'PAYMENT';
    const CODE_BANK_FUNC_CATEGORY_DONATION = 'DONATION';
    const CODE_EVENT_TYPE_AKAD = 'Akad';
    const CODE_EVENT_TYPE_RESEPSI = 'Resepsi';
    const GUEST_VAR_FROM_URL_REQ = 'to';
    const EXAMPLE_USER_URL = 'admin';
    const DEFAULT_COUNTRY_CODE = 'ID';
    const VISITOR_GRAPH_DISTANCE_UNIT = 'D'; //D = Day, M = Month
    const VISITOR_DATA_IN_LAST_UNIT = 7; //Jika VISITOR_GRAPH_DISTANCE_UNIT = 'D' dan VISITOR_DATA_IN_LAST_UNIT = 6, maka artinya adalah 6 hari terakhir
    const TEXT_CODE_GUEST = '{nama_tamu}';
    const TEXT_CODE_GROOM = '{pengantin_pria}';
    const TEXT_CODE_BRIDE = '{pengantin_wanita}';
    const TEXT_CODE_START_DAY = '{hari_mulai}';
    const TEXT_CODE_END_DAY = '{hari_selesai}';
    const TEXT_CODE_START_DATE = '{tanggal_mulai}';
    const TEXT_CODE_END_DATE = '{tanggal_selesai}';
    const TEXT_CODE_START_TIME = '{waktu_mulai}';
    const TEXT_CODE_END_TIME = '{waktu_selesai}';
    const TEXT_CODE_LOCATION = '{lokasi}';
    const TEXT_CODE_LINK = '{link}';
    const TNC_HTML_CONTENT = '<h1 class="text-center"><b>Syarat dan Ketentuan</b></h1><p>Penggunaan Anda atas UndanganAjib merupakan persetujuan Anda untuk terikat oleh ketentuan kami. Harap membaca dengan saksama sebelum menggunakan Layanan.</p><p>Anda setuju untuk menggunakan Layanan sesuai dengan Ketentuan ini. Anda dapat menggunakan Layanan hanya jika Anda memiliki kewenangan untuk menjalin kontrak dengan UndanganAjib dan tidak dilarang oleh hukum apapun yang berlaku untuk melakukan hal tersebut. Layanan dapat berubah dari waktu ke waktu. Perubahan tersebut, serta penangguhan dan modifikasi apapun mengenai Layanan, dapat dilakukan kapanpun tanpa pemberitahuan sebelumnya kepada Anda. Kami juga dapat menghapus konten apapun dari Layanan kami sesuai kebijaksanaan kami.</p><h3><b>Berkas dan Privasi Anda</b></h3><p>Dengan menggunakan Layanan kami, Anda dapat memberikan informasi pada kami, dan berkas yang Anda serahkan atau unggah melalui Layanan secara kolektif untuk selanjutnya disebut “Berkas Anda”. Anda mempertahankan kepemilikan penuh atas Berkas Anda. Ketentuan ini tidak memberikan kepada kami hak apapun atas Berkas Anda atau kekayaan intelektual Anda kecuali untuk hak-hak terbatas yang dibutuhkan untuk menjalankan Layanan, seperti yang dijelaskan di bawah ini.</p><h3><b>Berbagi Berkas Anda</b></h3><p>Layanan menyediakan fitur-fitur yang memperbolehkan Anda untuk mengunggah Berkas Anda untuk menyimpan dan membagikannya dengan individu-individu tertentu dalam teman dan keluarga Anda. UndanganAjib tidak memiliki tanggung jawab apapun untuk kegiatan tersebut.</p><h3><b>Kewajiban Anda</b></h3><p>Pihak lain dapat memiliki hak kekayaan intelektual atas Berkas dan konten lainnya dalam Layanan. Anda dilarang untuk menyalin, menggunggah, mengunduh, dan/atau membagikan Berkas, kecuali Anda memiliki hak untuk melakukannya. Anda, bukan UndanganAjib, akan bertanggung jawab terhadap apa yang Anda salin, bagikan, unggah, unduh, gunakan, dan/atau tindakan lainnya yang Anda lakukan saat menggunakan Layanan. Satu akun website undangan UndanganAjib hanya bisa digunakan untuk satu pasangan pernikahan, diluar ketetapan tersebut maka permintaan untuk pengubahan alamat website undangan tidak akan diproses oleh UndanganAjib. Anda tidak boleh menggunggah perangkat pengintai atau perangkat lunak hasad lainnya pada Layanan.</p><h3><b>Keamanan Akun</b></h3><p>Layanan menyediakan fitur-fitur yang memperbolehkan Anda untuk mengunggah Berkas Anda untuk disimpan dan dibagikan dengan individu-individu tertentu dalam teman dan keluarga Anda. UndanganAjib tidak memiliki kewajiban apapun terhadap tindakan tersebut.</p><h3><b>Kebijakan Pengembalian Dana (Refund Policy)</b></h3><p>UndanganAjib tidak memberlakukan pengembalian dana untuk paket yang sudah dibeli. Anda boleh mengajukan pengembalian dana jika: <br><ol><li>Anda melakukan pembayaran lebih dari yang seharusnya.</li><li>Salah melakukan transfer dana yang masuk ke rekening UndanganAjib.</li></ol></p>';
    const DEFAULT_GUEST_MESSAGE = "<p><i>Assalamu'alaikum warahmatullahi wabarakatuh.</i></p><p>Dengan hormat, izinkan Saya mengundang Saudara/ Saudari <b>".Constant::TEXT_CODE_GUEST."</b> untuk menghadiri acara pernikahan Kami, <b>".Constant::TEXT_CODE_GROOM."</b> dan <b>".Constant::TEXT_CODE_BRIDE."</b>&nbsp;yang akan diadakan pada:</p><p>Hari, Tanggal: <b>".Constant::TEXT_CODE_START_DAY."</b>, <b>".Constant::TEXT_CODE_START_DATE."</b></p><p>Pukul: <b>".Constant::TEXT_CODE_START_TIME."</b></p><p>Lokasi: <b>".Constant::TEXT_CODE_LOCATION."</b></p><p>Link Undangan: <b>".Constant::TEXT_CODE_LINK."</b></p><p>Akan menjadi suatu kehormatan apabila Saudara/ Saudari berkenan hadir di acara Kami.</p><p><i>Wassalamu'alaikum warahmatullahi wabarakatuh.</i></p>";
    const DEFAULT_ADMIN_EMAIL = 'admin@undanganajib.com';
    const DEFAULT_ADMIN_PHONES = ['+6282246668782','+6281513947715'];
    const DEFAULT_SUPPORT_EMAIL = 'support@undanganajib.com';
    const DEFAULT_OFFICE_LOCATION = 'Jakarta Selatan, Indonesia';

    const EXPIRED_DAY_OF_INVOICE_FIRST_MADE = 1;
    const EXPIRED_DAY_OF_PAYMENT_FIRST_MADE = 30;
    const EXPIRED_DAY_OF_PAYMENT_AFTER_CONFIRMED = 3;
    const MAX_UNCONFIRMED_PAYMENT_EACH_INVOICE = 1;
    const MIN_PRESENCE_OF_EACH_GUEST = 1;
    const MAX_PRESENCE_OF_EACH_GUEST = 9999;
    // end app
}
