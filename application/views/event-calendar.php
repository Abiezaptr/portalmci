<div class="page-content mb-1">
    <br><br>

    <section>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="list-style: none; padding: 0; margin: 0;">
                <li class="breadcrumb-item" style="display: inline; color: black;">
                    <a href="<?= site_url('home') ?>" style="color: black; text-decoration: none;">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page" style="color: rgb(177, 41, 41); display: inline;">
                    Event Calendar
                </li>
            </ol>
        </nav>
        <br>
        <!-- Sidebar -->
        <aside class="sidebar">
            <ol>
                <li><span>Events Calendar</span></li>
            </ol>
        </aside>

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold" style="color: maroon;">Calendar</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold" style="color: maroon;">Upcoming Event</h6>
                    </div>
                    <div class="card-body upcoming-event-section">
                        <div class="text-center">
                            <img src="<?= base_url('assets/images/no-comments.png') ?>" alt="No Comments" style="width: 100px; height: auto;">
                        </div>
                        <p class="text-center mt-3"><small>No upcoming events found.</small></p>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold" style="color: maroon;">Past Event</h6>
                    </div>
                    <div class="card-body past-event-section">
                        <?php if (!empty($past_events)): ?>
                            <?php foreach ($past_events as $event): ?>
                                <div class="event-card mb-4 p-3" style="border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                    <div class="text-center">
                                        <img src="<?= base_url('uploads/event/' . $event->image) ?>"
                                            alt="<?= htmlspecialchars($event->title) ?>"
                                            style="width: 100%; height: auto; border-radius: 10px 10px 0 0;">
                                    </div>
                                    <div style="padding: 10px;">
                                        <h6 style="font-weight: bold; color: #800000;">
                                            <?= htmlspecialchars($event->title) ?>
                                        </h6>
                                        <hr>
                                        <p style="font-size: 14px; color: #777; margin-bottom: 5px;">
                                            <i class="fa fa-calendar-day"></i>&nbsp;
                                            <?= date('d M Y', strtotime($event->start_date)) ?> - <?= date('d M Y', strtotime($event->end_date)) ?>
                                        </p>
                                        <p style="font-size: 14px; color: #555; margin-top: -5px;">
                                            <i class="fa fa-map-marker-alt"></i>&nbsp;
                                            <?= htmlspecialchars($event->location) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center">
                                <img src="<?= base_url('assets/images/no-comments.png') ?>" alt="No Past Events" style="width: 100px; height: auto;">
                            </div>
                            <p class="text-center mt-3"><small>No past events found.</small></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
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
        margin-left: -4px;
        /* Geser sedikit ke kiri */
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