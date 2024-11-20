<div class="page-content mb-1">
    <br><br>

    <section>
        <!-- Sidebar -->
        <aside class="sidebar">
            <ol>
                <li><span>Latest Articles</span></li>
            </ol>
        </aside>
        <div class="article-container mt-5">
            <?php foreach ($articles as $article): ?>
                <div class="article">
                    <a href="<?= site_url('view-article/' . urlencode(str_replace(' ', '-', $article['title']))) ?>" style="text-decoration: none;">
                        <img src="<?php echo base_url('uploads/image/' . $article['image']); ?>" alt="Article 1" class="article-image">
                        <div class="article-content">
                            <div class="article-header">
                                <span class="article-category"><?= htmlspecialchars($article['category']); ?></span>
                                <span class="article-date"><?= date('F d, Y', strtotime($article['date'])); ?></span>
                            </div>
                            <h3 class="article-title"> <?= (strlen($article['title']) > 100) ? htmlspecialchars(substr($article['title'], 0, 60)) . '...' : htmlspecialchars($article['title']); ?></h3>
                            <p class="article-desc"> <?= (strlen($article['desc']) > 100) ? htmlspecialchars(substr($article['desc'], 0, 100)) . '...' : htmlspecialchars($article['desc']); ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
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