<div class="page-content mb-1">
    <br><br><br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="list-style: none; padding: 0; margin: 0;">
            <li class="breadcrumb-item" style="display: inline; color: black;">
                <a href="<?= site_url('home') ?>" style="color: black; text-decoration: none;">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="color: rgb(177, 41, 41); display: inline;">
                Latest Articles
            </li>
        </ol>
    </nav>

    <div class="card-container mt-5">
        <?php foreach ($articles as $article): ?>
            <div class="card">
                <div class="card-title"><?= htmlspecialchars($article['title']); ?></div>
                <div class="card-subtitle">
                    <span class="badge badge-maroon"><?= htmlspecialchars($article['category']); ?></span>
                </div>
                <div class="card-text">
                    <?= (strlen($article['desc']) > 100) ? htmlspecialchars(substr($article['desc'], 0, 100)) . '...' : htmlspecialchars($article['desc']); ?>
                </div>
                <a href="<?= site_url('view-article/' . urlencode(str_replace(' ', '-', $article['title']))) ?>" class="card-link">Learn more</a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Tambahkan Pagination -->
    <div class="pagination-container mt-4">
        <?= $pagination; ?>
    </div>


</div>

<style>
    .card-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .badge {
        display: inline-block;
        padding: 0.15em 0.3em;
        /* Lebih kecil dari sebelumnya */
        font-size: 0.75rem;
        /* Ukuran font lebih kecil */
        font-weight: 400;
        /* Berat font tetap */
        color: #fff;
        /* Warna teks */
        background-color: #800000;
        /* Warna maroon */
        border-radius: 0.2rem;
        /* Sedikit lebih kecil */
        text-transform: capitalize;
        /* Opsional, kapitalisasi */
    }



    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #fff;
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-subtitle {
        font-size: 14px;
        color: #888;
        margin-bottom: 15px;
    }

    .card-text {
        font-size: 14px;
        margin-bottom: 15px;
        color: #555;
    }

    .card-link {
        font-size: 14px;
        color: rgb(177, 41, 41);
        text-decoration: none;
        font-weight: bold;
    }

    .card-link:hover {
        text-decoration: underline;
    }
</style>