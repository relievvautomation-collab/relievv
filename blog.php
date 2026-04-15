<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- =============================================
         SEO META TAGS — RELIEVV BLOG PAGE
         ============================================= -->
 
    <!-- Primary SEO -->
    <title>Blog – Relievv | Finance, Audit & Accounts Automation Insights | Made in India</title>
    <meta name="description" content="Read the Relievv blog for insights on finance automation, audit tools, Excel tips, TDS reconciliation, GSTR filing, and how CA professionals can work smarter. Written by a Chartered Accountant.">
    <meta name="keywords" content="Relievv blog, finance automation blog, CA tools blog India, Excel tips for accountants, TDS reconciliation guide, GSTR filing tips, audit automation India, accounting tools blog, finance professional tips India, free CA tools blog">
    <meta name="author" content="Relievv Automation">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://relievv.in/blog">
 
    <!-- Open Graph (Facebook, LinkedIn, WhatsApp) -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Blog – Relievv | Finance, Audit & Accounts Automation Insights">
    <meta property="og:description" content="Insights on finance automation, Excel tips, TDS reconciliation, GSTR filing, and audit tools for CA professionals in India. Written by a Chartered Accountant.">
    <meta property="og:url" content="https://relievv.in/blog">
    <meta property="og:site_name" content="Relievv Automation">
    <!-- <meta property="og:image" content="https://relievv.in/assets/images/og-relievv.png"> -->
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_IN">
 
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Blog – Relievv | Finance & Audit Automation Insights">
    <meta name="twitter:description" content="Finance automation tips, Excel guides, TDS & GSTR insights for CA and audit professionals in India. Read the Relievv blog.">
    <!-- <meta name="twitter:image" content="https://relievv.in/assets/images/og-relievv.png"> -->
    <meta name="twitter:site" content="@relievv">
 
    <!-- Geo & Language -->
    <meta name="geo.region" content="IN">
    <meta name="geo.country" content="India">
    <meta name="language" content="English">
 
    <!-- Schema.org — Blog -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Blog",
      "name": "Relievv Blog",
      "url": "https://relievv.in/blog",
      "description": "Insights on finance automation, Excel tips, TDS reconciliation, GSTR filing, and audit tools for CA and finance professionals in India.",
      "publisher": {
        "@type": "Organization",
        "name": "Relievv Automation",
        "url": "https://relievv.in",
        "logo": "https://relievv.in/assets/images/logo.png"
      },
      "blogPost": [
        {
          "@type": "BlogPosting",
          "headline": "The Future of Finance Work",
          "description": "Tools like Excel and traditional accounting software have helped streamline financial workflows, they still require extensive manual effort for tasks like data formatting, data extraction, reconciliation, and reporting.",
          "url": "https://relievv.in/blog-details",
          "image": "https://relievv.in/assets/images/blog-details.jpeg",
          "author": {
            "@type": "Person",
            "name": "Rahul",
            "jobTitle": "Chartered Accountant"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Relievv Automation",
            "url": "https://relievv.in"
          }
        }
      ]
    }
    </script>
 
    <!-- Schema.org — BreadcrumbList -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Home",
          "item": "https://relievv.in"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Blog",
          "item": "https://relievv.in/blog"
        }
      ]
    }
    </script>
 
    <!-- =============================================
         END SEO META TAGS
         ============================================= -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/sweetalert2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
  <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
</head>
<body>
<?php 
include 'header.php';
include 'config/connection.php';
// Default placeholders (used when DB values/images are missing)
$defaultCardImageSrc = "./assets/images/blog-details.jpeg";
$defaultCardTitle = "The Future of Finance Work";
$defaultCardDesc = "Tools like Excel and traditional accounting software have helped streamline financial workflows, they still require extensive manual effort for tasks like data formatting, data extraction, reconciliation, and reporting.";

$truncateWords = function ($text, $limitWords) {
    // Limit by characters (letters), not words.
    $clean = trim(preg_replace('/\s+/u', ' ', strip_tags((string) $text)));
    if ($clean === '') {
        return '';
    }

    $limit = (int) $limitWords;
    if ($limit <= 0) {
        return '';
    }

    $length = function_exists('mb_strlen') ? mb_strlen($clean, 'UTF-8') : strlen($clean);
    if ($length <= $limit) {
        return $clean;
    }

    $substr = function_exists('mb_substr') ? mb_substr($clean, 0, $limit, 'UTF-8') : substr($clean, 0, $limit);
    return trim($substr) . '...';
};

$blogQuery = mysqli_query($con, "SELECT id, encrytiduniq, thumbimages, title, shortdescription FROM tblblog ORDER BY id DESC");

?>


    <!-- Blog Section Start -->
<section class="why-choose">
        <div class="container">
           <div class="text-center w-100 d-flex flex-column align-items-center justify-content-center mb-3">
             <h2 class="section-title">Blog</h2>
        
           </div>


           <div class="row g-3 position-relative">
                <?php
                $foundAny = false;
                if ($blogQuery && mysqli_num_rows($blogQuery) > 0) {
                    while ($row = mysqli_fetch_assoc($blogQuery)) {
                        $foundAny = true;
                        $cardTitle = !empty($row['title']) ? $row['title'] : $defaultCardTitle;
                        $cardDesc = !empty($row['shortdescription']) ? $row['shortdescription'] : $defaultCardDesc;
                        $cardImageSrc = $defaultCardImageSrc;

                        if (!empty($row['thumbimages']) && file_exists(__DIR__ . '/uploads/' . $row['thumbimages'])) {
                            $cardImageSrc = 'uploads/' . $row['thumbimages'];
                        }
                        ?>
                        <div class="col-lg-4 col-12  px-2 rounded-0">
                            <div class="d-flex flex-column  shadow-lg rounded-0 align-items-start position-relative h-100">
                                <div class="blog-img-box">
                                    <img src="<?php echo htmlspecialchars($cardImageSrc); ?>" alt="blog" class="w-100 h-100   rounded-2" style="object-fit: fill;">
                                </div>
                                <div class="p-3 w-100 d-flex flex-column align-items-start justify-content-between h-100">
                                <div class="d-flex flex-column align-items-start justify-content-center">
                                <h5 class="mb-1 head-title-blog"><?php echo htmlspecialchars($cardTitle); ?></h5>
                                <p class="mb-0 font-size-paragraph text-justify"><?php echo htmlspecialchars($truncateWords($cardDesc, 130)); ?></p>
                                </div>
                                    <a href="blog-details?id=<?php echo htmlspecialchars(!empty($row['encrytiduniq']) ? $row['encrytiduniq'] : (string) ((int) $row['id'])); ?>" class="btn-use-tool w-100 mt-auto text-decoration-none text-center">Read More</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }

                // If DB has no blog rows, keep the UI card visible with defaults.
                if (!$foundAny) {
                    ?>
                    <div class="col-lg-4 col-12  shadow-lg px-0">
                        <div class="d-flex flex-column align-items-start position-relative">
                            <div class="blog-img-box">
                                <img src="<?php echo htmlspecialchars($defaultCardImageSrc); ?>" alt="blog" class="w-100 h-100 object-fit-cover rounded-2">
                            </div>
                            <div class="p-3 w-100 d-flex flex-column align-items-start justify-content-center" style="height: 200px;">
                            <h5 class="mb-3 head-title-blog"><?php echo htmlspecialchars($defaultCardTitle); ?></h5>
                            <p class="mb-0 font-size-paragraph"><?php echo htmlspecialchars($truncateWords($defaultCardDesc, 100)); ?></p>
                            <a href="blog-details" class="btn-use-tool w-100 mt-auto text-decoration-none text-center">Read More</a>
                        </div>
                    </div>
                </div>
            <?php
        }
        ?>
    </div>
</section>

<!-- Blog Section End -->

<?php include 'footer.php'; ?>
     <script src="assets/js/jquery.min.js"></script>
     <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="assets/js/toast.js"></script>
</body>

</html>
