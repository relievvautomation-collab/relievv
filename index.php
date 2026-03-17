<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relievv</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
      <!-- Google tag (gtag.js) -->
       <script async src="https://www.googletagmanager.com/gtag/js?id=G-5NLNR1DHVE"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-5NLNR1DHVE');
        </script>
  <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/svg+xml" href="favicon/favicon.svg" />
  <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />
</head>
<body>
  <?php include 'header.php'; ?>
 
    <!-- Hero Section -->
    <section class="hero-section" id="home">
        <div class="container">
            <h1> Professional Online Tools Suite</h1>
            <p>Eliminate manual tasks in finance, audit, and accounts with powerful automation tools. Made in India with ❤️ to help professionals work smarter, not harder.</p>
            <p class="subtext">More tools coming soon to revolutionize your workflow!</p>
            <button class="btn btn-browse"  onclick="windowredirecturl('https://relievv.in/#tools', '_self')">Browse Tools</button>
        </div>
    </section>

        <!-- Total Users Section Start -->
 <section class="current-tools">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3 col-6 text-center">
                <h2 class="counter-total" id="counter1" data-target="5">0+</h2>
                <div class="d-flex align-items-center flex-column">
                    <p class="text-uppercase   mb-0">free tools</p>
                    <span class="color-light-border">& growing</span>
                </div>
            </div>
            <div class="col-md-3 col-6 text-center">
                <h2 class="counter-total" id="counter2" data-target="1500">0+</h2>
                <div class="d-flex align-items-center flex-column">
                    <p class="text-uppercase  mb-0">files processed</p>
                    <span class="color-light-border">by professionals</span>
                </div>
            </div>
            <!-- <div class="col-md-3 col-6 text-center">
                <h2 class="counter-total" id="counter3" data-target="95">0%</h2>
                <p>Customer Satisfaction</p>
            </div> -->
            <div class="col-md-3 col-6 text-center">
                <h2 class="counter-total" id="counter4" data-target="24">0/7</h2>
                <p>Support Available</p>
            </div>
        </div>
    </div>
</section>



 
    <!-- Total Users Section End -->
    <!-- Current Tools Section -->
    <section class="current-tools pt-3" id="tools">
        <div class="container">
            <h2 class="section-title">Current Tools</h2>
            <p class="section-subtitle">Automate boring manual tasks in finance, audit, and accounts. More powerful tools coming soon!</p>
            
            <div class="row gy-3">
                <div class="col-md-6 col-lg-3">
                    <div class="tool-card" id="tool-merge">
                        <div class="tool-icon">
                            <i class="fas fa-file-excel"></i>
                        </div>
                        <h5>Excel Sheet Consolidator</h5>
                        <p>Merge multiple Excel worksheets into a single structured master sheet for unified financial data analysis.</p>
                       
                              <button class="btn-use-tool"
                            onclick="windowredirecturl('https://excel-sheet.relievv.in', '_blank')">
                            Use Tool
                            </button>
                     
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3" >
                    <div class="tool-card" id="tool-combine">
                        <div class="tool-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <h5>Excel Workbook Integrator</h5>
                        <p>Unify multiple Excel workbooks into a single consolidated file for streamlined reporting and reconciliation workflows.</p>
                        
                        <button class="btn-use-tool"
                            onclick="window.location.href='https://excel-workbook.relievv.in'">
                            Use Tool
                        </button>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="tool-card" id="tool-audit">
                        <div class="tool-icon">
                            <i class="fas fa-random"></i>
                        </div>
                        <h5>Audit Sampling Tool</h5>
                        <p>Supports data sampling and audit sampling for your financial and compliance needs.</p>
                        <button class="btn-use-tool">Coming Soon</button>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="tool-card" id="tool-converter">
                        <div class="tool-icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <h5>26AS Converter</h5>
                        <p>Convert 26AS into excel or alternate pro-rata formatted Excel for easy analysis.</p>
                    
                          <button class="btn-use-tool"
                            onclick="windowredirecturl('https://26as.relievv.in', '_blank')">
                            Use Tool
                            </button>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="tool-card" id="tool-bank-parser">
                        <div class="tool-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <h5>Bank Statement Parser</h5>
                        <p>Convert system-generated PDF bank statements into structured Excel format for financial analysis and reconciliation.</p>

                        <button class="btn-use-tool"
                            onclick="window.open('https://bank.relievv.in', '_blank')">
                            Use Tool
                        </button>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="tool-card" id="tool-gstr-consolidator">

                        <div class="tool-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>

                    <h5>GSTR Consolidator</h5>
                    <p>Merge multiple months GSTR-1, GSTR-3B, and GSTR-2A JSON files into a single structured master report.</p>

                    <button class="btn-use-tool"
                    onclick="window.open('https://gstr.relievv.in', '_blank')">
                     Use Tool
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Browse by Category Section -->
    <section class="category-section" id="categories">
        <div class="container">
            <h2 class="section-title">Browse by Category</h2>
            <p class="section-subtitle">Find the right tool for your finance, audit, and accounts needs</p>
            
            <div class="row gy-3">
                <div class="col-md-4">
                    <div class="category-card d-flex align-items-start">
                        <div class="category-icon flex-shrink-0 me-3">
                            <i class="fas fa-file-excel"></i>
                        </div>
                       <div class="flex-grow-1 d-flex flex-column align-items-start h-100">
                         <h5 >Excel Related</h5>
                        <p>Excel-focused utilities for merging sheets, comparing workbooks, cleaning data, and more.</p>
                        <a href="#tools" class="cat-link mt-auto text-decoration-none ">View Tools <i class="fas fa-arrow-right ms-2"></i></a>
                       </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="category-card  d-flex align-items-start">
                        <div class="category-icon flex-shrink-0 me-3">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                      <div class="flex-grow-1 d-flex flex-column align-items-start h-100">
                          <h5>Audit</h5>
                        <p>Professional audit tools for sampling, compliance, and financial verification.</p> 
                        <a href="#tool-audit" class="cat-link mt-auto text-decoration-none">Audit Sampling Tool <i class="fas fa-arrow-right ms-2"></i></a>
                       
                      </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="category-card d-flex align-items-start">
                        <div class="category-icon flex-shrink-0 me-3">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div class="flex-grow-1 d-flex flex-column align-items-start h-100">

                            <h5>Converter</h5>
                            <p>Convert tax documents and finance statements into easy-to-use formats in Excel.</p>
                            <a href="#tool-converter" class="cat-link mt-auto text-decoration-none">26AS Parser Tools<i class="fas fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose">
        <div class="container">
            <h2 class="section-title">Why Choose Us</h2>
            <p class="section-subtitle">Built with professionals in mind, our platform delivers the performance and reliability you need</p>
            
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h5>Speed</h5>
                        <p>Lightning-fast processing ensures your tasks are completed quickly without compromising quality</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>Security</h5>
                        <p>Your data is processed with industry-standard encryption and secure processing protocols</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-smile"></i>
                        </div>
                        <h5>Ease of Use</h5>
                        <p>Intuitive interfaces designed with efficiency, requiring no technical expertise to get started</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5>Reliability</h5>
                        <p>Consistent performance you can depend on, backed by robust infrastructure and regular updates</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Ready to Get Started?</h2>
            <p>Join thousands of professionals who trust our platform for their daily workflow. Start using our tools today—no signup required.</p>
            <button class="btn btn-explore">Explore All Tools</button>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <h2>About RELIEVV</h2>
            <p>RELIEVV is built and created by <span class="highlight-text">Rahul</span>, a <strong>Chartered Accountant</strong> with a strong financial background and a vision to transform the way finance, audit, and accounts professionals work.</p>
            <p>Frustrated by how tedious manual tasks that consume valuable time in the financial sector, Rahul set out to automate these boring, repetitive processes. RELIEVV is the result of this vision—a suite of powerful tools designed to help finance and audit professionals work more efficiently and focus on what truly matters.</p>
            <p><span class="highlight-text text-dark">Built in India with ❤️</span></p>
        </div>
    </section>
    <!-- Contact Section -->
    <section class="about-section pt-2 pb-4" id="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Have questions or need assistance? Reach out to us anytime.</p>
            <p>Email: <a href="mailto: relievvautomation@gmail.com" class="text-dark fw-bold">relievvautomation@gmail.com</a></p>
        </div>
    </section>
  <!-- Data Safety and Privacy Policy  -->
     <section class="about-section pt-2 pb-4" id="contact">
        <div class="container">
             <div class="row">
                 <a href="privacy-policy" class="text-dark text-center text-decoration-none fw-bold"><h6>Data Safety and Privacy Policy</h6></a>
             </div>
        </div>
    </section>

   <!-- footer section start -->
    <?php include 'footer.php'; ?>

     <script src="assets/js/script.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>counteranimation();</script>
</body>

</html>



















