<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.ico') ?>">
    <title>SIM | Login</title>
    <style>
    /* Reset ringan */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --bg1: #0f172a;
        --bg2: #0b1020;
        --accent: #ff6b6b;
        --accent-2: #ffb86b;
        --glass: rgba(255, 255, 255, 0.06);
        --glass-2: rgba(255, 255, 255, 0.04);
        --text: #e6eef8;
        --muted: #9fb0c8;
        --shadow: 0 8px 30px rgba(2, 6, 23, 0.6);
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI",
            Roboto, "Helvetica Neue", Arial;
    }

    html,
    body {
        height: 100%;
        background: linear-gradient(135deg, var(--bg1), var(--bg2));
        color: var(--text);
    }

    /* background pattern */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: 0;
        background-image:
            radial-gradient(circle at 10% 10%, rgba(255, 107, 107, 0.06) 0 2px, transparent 2px),
            radial-gradient(circle at 90% 90%, rgba(255, 184, 107, 0.04) 0 3px, transparent 3px);
        pointer-events: none;
        opacity: 0.9;
        mix-blend-mode: screen;
    }

    .wrap {
        min-height: 100vh;
        display: grid;
        place-items: center;
        padding: 32px;
        position: relative;
        z-index: 1;
    }

    .card {
        width: 100%;
        max-width: 980px;
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 28px;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.02));
        border-radius: 16px;
        padding: 28px;
        box-shadow: var(--shadow);
        backdrop-filter: blur(10px) saturate(120%);
        border: 1px solid rgba(255, 255, 255, 0.04);
        overflow: hidden;
    }

    .hero {
        display: block;
    }

    /* left hero */
    .hero {
        padding: 28px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 18px;
        position: relative;
    }

    .brand {
        display: flex;
        gap: 12px;
        align-items: center;
    }

    .logo {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--accent), var(--accent-2));
        display: grid;
        place-items: center;
        font-weight: 700;
        color: #111;
        box-shadow: 0 6px 18px rgba(255, 107, 107, 0.18);
    }

    .brand h1 {
        font-size: 20px;
        letter-spacing: 0.2px;
    }

    .brand p {
        color: var(--muted);
        font-size: 13px;
        margin-top: -2px;
    }

    .hero h2 {
        font-size: 28px;
        line-height: 1.02;
        margin-top: 6px;
    }

    .hero p.lead {
        color: var(--muted);
        font-size: 15px;
        max-width: 36ch;
    }

    .features {
        display: flex;
        gap: 12px;
        margin-top: 8px;
        flex-wrap: wrap;
    }

    .chip {
        background: var(--glass);
        padding: 8px 12px;
        border-radius: 999px;
        color: var(--text);
        font-size: 13px;
        border: 1px solid rgba(255, 255, 255, 0.03);
    }

    /* right form */
    .login-box {
        padding: 28px;
        border-radius: 12px;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.02), rgba(255, 255, 255, 0.01));
        display: flex;
        flex-direction: column;
        gap: 14px;
        align-self: center;
        min-height: 360px;
    }

    .login-box h3 {
        margin-bottom: 6px;
    }

    .desc {
        color: var(--muted);
        font-size: 13px;
        margin-bottom: 6px;
    }

    form .field {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 8px;
    }

    label {
        font-size: 13px;
        color: var(--muted);
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.04);
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.01), rgba(255, 255, 255, 0.00));
        color: var(--text);
        outline: none;
        font-size: 14px;
        transition: box-shadow .18s, transform .12s;
    }

    input:focus {
        box-shadow: 0 6px 20px rgba(12, 18, 40, 0.45);
        transform: translateY(-1px);
        border-color: rgba(255, 184, 107, 0.18);
    }

    .password-wrap {
        position: relative;
    }

    .toggle-pw {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--muted);
        font-size: 13px;
        padding: 6px;
        border-radius: 8px;
    }

    .row {
        display: flex;
        gap: 12px;
        align-items: center;
        justify-content: space-between;
    }

    .remember {
        display: flex;
        gap: 8px;
        align-items: center;
        font-size: 13px;
        color: var(--muted);
    }

    .btn {
        background: linear-gradient(90deg, var(--accent), var(--accent-2));
        border: none;
        color: #08111a;
        padding: 12px 16px;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 8px 30px rgba(255, 107, 107, 0.12);
        transition: transform .12s, box-shadow .12s;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 34px rgba(255, 107, 107, 0.16);
    }

    .alt {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: center;
        margin-top: 6px;
    }

    .social {
        display: flex;
        gap: 8px;
        justify-content: center;
        margin-top: 6px;
    }

    .social button {
        border-radius: 10px;
        padding: 10px 12px;
        border: 1px solid rgba(255, 255, 255, 0.03);
        background: var(--glass-2);
        color: var(--text);
        cursor: pointer;
        min-width: 120px;
    }

    footer.small {
        font-size: 12px;
        color: var(--muted);
        text-align: center;
        margin-top: 8px;
    }

    /* small screens */
    @media (max-width:900px) {

        .hero {
            display: none;
        }

        .card {
            grid-template-columns: 1fr;
            max-width: 520px;
            padding: 18px;
            gap: 18px;
        }

        .hero {
            order: 2;
            padding: 12px 6px 6px 6px;
            text-align: center;
        }

        .login-box {
            order: 1;
            padding: 18px;
        }

        .brand {
            justify-content: center;
        }

        .features {
            justify-content: center;
        }
    }
    </style>
</head>

<body>


    <main role="main" class="container">
        <?= $this->renderSection('main') ?>
    </main><!-- /.container -->


    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <?= $this->renderSection('pageScripts') ?>
</body>

</html>