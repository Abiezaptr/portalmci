<div class="page-content mb-1">
    <br><br>

    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="list-style: none; padding: 0; margin: 0;">
                <li class="breadcrumb-item" style="display: inline; color: black;">
                    <a href="<?= site_url('home') ?>" style="color: black; text-decoration: none;">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: rgb(177, 41, 41); display: inline;">
                    Semua Topik
                </li>
            </ol>
        </nav>
        <div class="article-container mt-5">
            <?php if (!empty($threads)): ?>
                <?php foreach ($threads as $thread): ?>
                    <div class="article">
                        <a href="<?php echo base_url('form-discussion/' . $thread['id']); ?>" style="text-decoration: none;">
                            <img src="<?php echo base_url('uploads/forum_threads/' . $thread['image']); ?>" alt="Article 1" class="article-image">
                            <div class="article-content">
                                <div class="article-header">
                                    <span class="article-category"><?= htmlspecialchars($thread['category_name']); ?></span>
                                    <span class="article-date"><?= date('F d, Y', strtotime($thread['created_at'])); ?></span>
                                </div>
                                <h3 class="article-title"> <?= (strlen($thread['title']) > 100) ? htmlspecialchars(substr($thread['title'], 0, 60)) . '...' : htmlspecialchars($thread['title']); ?></h3>
                                <p class="article-desc"> <?= (strlen($thread['content']) > 100) ? htmlspecialchars(substr($thread['content'], 0, 100)) . '...' : htmlspecialchars($thread['content']); ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    Tidak ada topik yang tersedia.
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Tambahkan Pagination -->
    <div class="pagination-container mt-4">
        <?= $pagination; ?>
    </div>
</div>

<style>
    /* Container untuk grid */
    .article-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        /* 3 kolom per baris */
        gap: 20px;
        margin: 20px;
    }

    /* Gaya untuk setiap artikel (card) */
    .article {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Gambar artikel */
    .article-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    /* Konten artikel */
    .article-content {
        padding: 15px;
    }

    /* Kategori dan tanggal */
    .article-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .article-category {
        background-color: #ff5722;
        color: white;
        font-size: 12px;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 15px;
        text-transform: capitalize;
    }

    .article-date {
        font-size: 12px;
        color: #888;
    }

    /* Judul dan deskripsi */
    .article-title {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin: 10px 0;
    }

    .article-desc {
        font-size: 14px;
        color: #555;
    }

    /* Gaya untuk daftar samping (ol) */
    .sidebar {
        margin: 20px;
    }

    .sidebar-title {
        font-size: 22px;
        /* Membesarkan ukuran judul */
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .sidebar ol {
        list-style: none;
        padding-left: 0;
    }

    .sidebar li {
        margin-bottom: 15px;
        /* Menambah jarak antar daftar */
        display: flex;
        align-items: center;
        background-color: #fff;
        /* Latar belakang putih untuk card */
        border-left: 6px solid #ff5722;
        /* Border kiri oranye */
        padding: 15px;
        /* Padding di dalam card */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        /* Efek timbul */
        border-radius: 8px;
        /* Membuat sudut card membulat */
        transition: transform 0.2s ease-in-out;
        /* Efek saat hover */
    }

    /* Hover efek untuk card */
    .sidebar li:hover {
        transform: scale(1.03);
        /* Sedikit memperbesar saat hover */
    }

    .sidebar li span {
        font-size: 18px;
        /* Membesarkan ukuran teks daftar */
        color: #333;
        /* Warna teks yang lebih gelap */
    }
</style>