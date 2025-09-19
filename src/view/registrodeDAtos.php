<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="/src/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="/src/js/script.js" async></script>
</head>

<body>
    <main class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg px-0">
                <h1 class="display-2 fst-italic text-center">dashboards</h1>
            </div>
        </div>


        <div class="row g-5">

            <div class="col-md-3">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="col-lg-4 text-center">
                        <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect>
                        </svg>
                        <h2 class="fw-normal" style="  @media (wifht < 740px){text-align:center; width:180px;}">
                            Heading
                        </h2>
                        <p>Some representative placeholder content for the three columns of text below the carousel.
                            This is the first column.</p>
                        <p><a class="btn btn-secondary" href="#">View details »</a></p>
                    </div>


                </div>
            </div>

            <div class="col-md-8">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">
                    From the Firehose
                </h3>

                <article class="blog-post">
                    <h2 class="display-5 link-body-emphasis mb-1">Sample blog post</h2>
                    <p class="blog-post-meta">January 1, 2021 by <a href="#">Mark</a></p>


                    <p>This is some additional paragraph placeholder content. It has been written to fill the available
                        space and show how a longer snippet of text affects the surrounding content. We'll repeat it
                        often to keep the demonstration flowing, so be on the lookout for this exact same string of
                        text.</p>
                    <h3>Sub-heading</h3>
                    <p>This is some additional paragraph placeholder content. It has been written to fill the available
                        space and show how a longer snippet of text affects the surrounding content. We'll repeat it
                        often to keep the demonstration flowing, so be on the lookout for this exact same string of
                        text.</p>
                    <pre><code>Example code block</code></pre>
                    <p>This is some additional paragraph placeholder content. It's a slightly shorter version of the
                        other highly repetitive body text used throughout.</p>
                </article>

                <div class="bd-example-snippet bd-code-snippet">
                    <div class="bd-example m-0 border-0">

                        <table class="table table-dark table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="bd-example m-0 border-0">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Class</th>
                                <th scope="col">Heading</th>
                                <th scope="col">Heading</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Default</th>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>

                            <tr class="table-primary">
                                <th scope="row">Primary</th>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr class="table-secondary">
                                <th scope="row">Secondary</th>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr class="table-success">
                                <th scope="row">Success</th>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr class="table-danger">
                                <th scope="row">Danger</th>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr class="table-warning">
                                <th scope="row">Warning</th>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr class="table-info">
                                <th scope="row">Info</th>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr class="table-light">
                                <th scope="row">Light</th>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr class="table-dark">
                                <th scope="row">Dark</th>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <nav class="blog-pagination" aria-label="Pagination">
                    <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
                    <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
                </nav>

            </div>


        </div>

    </main>
</body>

</html>