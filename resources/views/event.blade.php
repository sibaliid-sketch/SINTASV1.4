<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exclusive Events - Sibali.id</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700|montserrat:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --maroon-dark: #800000;
            --blue-dark: #000080;
            --maroon-light: #a30000;
            --blue-light: #0000a3;
            --cream: #f8f5f0;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
            --dark-gray: #333333;
            --text-dark: #222222;
            --text-light: #666666;
            --shadow-soft: 0 8px 30px rgba(128, 0, 0, 0.08);
            --shadow-medium: 0 12px 40px rgba(0, 0, 128, 0.12);
            --shadow-strong: 0 20px 60px rgba(0, 0, 128, 0.15);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Artsy Navigation - Dynamic & Creative */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--medium-gray);
            padding: 1.25rem 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar.scrolled {
            padding: 0.8rem 0;
            box-shadow: var(--shadow-soft);
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.75rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--blue-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-decoration: none;
            position: relative;
            padding: 0.5rem 0;
        }

        .logo::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40%;
            height: 3px;
            background: linear-gradient(90deg, var(--maroon-dark), var(--blue-dark));
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .logo:hover::after {
            width: 100%;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 0.5rem 0;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-links a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--maroon-dark), var(--blue-dark));
            transition: width 0.3s ease;
            border-radius: 1px;
        }

        .nav-links a:hover {
            color: var(--maroon-dark);
        }

        .nav-links a:hover::before {
            width: 100%;
        }

        .nav-links a.active {
            color: var(--maroon-dark);
            font-weight: 600;
        }

        .nav-links a.active::before {
            width: 100%;
            background: linear-gradient(90deg, var(--maroon-dark), var(--blue-dark));
        }

        .nav-cta {
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--blue-dark) 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(128, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .nav-cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--maroon-dark) 100%);
            transition: left 0.4s ease;
            z-index: -1;
        }

        .nav-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(128, 0, 0, 0.3);
        }

        .nav-cta:hover::before {
            left: 0;
        }

        /* Dynamic Hero Section - Artsy & Creative */
        .hero {
            padding: 14rem 0 8rem;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #f8f5f0 0%, #ffffff 100%);
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.6;
            background: 
                radial-gradient(circle at 10% 20%, rgba(128, 0, 0, 0.08) 0%, transparent 20%),
                radial-gradient(circle at 90% 30%, rgba(0, 0, 128, 0.06) 0%, transparent 20%),
                radial-gradient(circle at 50% 80%, rgba(128, 0, 0, 0.05) 0%, transparent 20%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-badge {
            display: inline-block;
            padding: 0.6rem 1.5rem;
            background: rgba(128, 0, 0, 0.1);
            border: 1px solid rgba(128, 0, 0, 0.2);
            border-radius: 50px;
            color: var(--maroon-dark);
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 2.5rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            backdrop-filter: blur(10px);
        }

        .hero-title {
            font-size: 3.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--blue-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.1;
        }

        .hero-subtitle {
            font-size: 1.35rem;
            color: var(--text-light);
            margin-bottom: 3.5rem;
            line-height: 1.7;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-actions {
            display: flex;
            gap: 1.25rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--blue-dark) 100%);
            color: white;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            box-shadow: var(--shadow-medium);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--maroon-dark) 100%);
            transition: left 0.4s ease;
            z-index: -1;
        }

        .btn-primary:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-strong);
        }

        .btn-primary:hover::before {
            left: 0;
        }

        .btn-secondary {
            background: transparent;
            color: var(--maroon-dark);
            padding: 1.2rem 3rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            border: 2px solid var(--maroon-dark);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: var(--maroon-dark);
            transition: width 0.4s ease;
            z-index: -1;
        }

        .btn-secondary:hover {
            color: white;
            border-color: var(--maroon-dark);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(128, 0, 0, 0.15);
        }

        .btn-secondary:hover::before {
            width: 100%;
        }

        /* Featured Event - Dynamic Card Design */
        .featured-event {
            padding: 8rem 0;
            background: var(--cream);
            position: relative;
        }

        .featured-event::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(45deg, transparent 65%, rgba(128, 0, 0, 0.03) 65%, rgba(128, 0, 0, 0.03) 70%, transparent 70%),
                linear-gradient(-45deg, transparent 65%, rgba(0, 0, 128, 0.03) 65%, rgba(0, 0, 128, 0.03) 70%, transparent 70%);
            pointer-events: none;
        }

        .section-header {
            text-align: center;
            margin-bottom: 5rem;
            position: relative;
        }

        .section-badge {
            display: inline-block;
            padding: 0.6rem 1.5rem;
            background: rgba(0, 0, 128, 0.1);
            border: 1px solid rgba(0, 0, 128, 0.2);
            border-radius: 50px;
            color: var(--blue-dark);
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .section-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--dark-gray);
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--maroon-dark), var(--blue-dark));
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            max-width: 650px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .event-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-strong);
            position: relative;
            padding: 0;
        }

        .event-image {
            height: 100%;
            min-height: 500px;
            overflow: hidden;
            position: relative;
        }

        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .event-image:hover img {
            transform: scale(1.08);
        }

        .event-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(128, 0, 0, 0.1), transparent);
            pointer-events: none;
        }

        .event-details {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .event-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-gray);
            line-height: 1.2;
        }

        .event-meta {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-light);
        }

        .meta-icon {
            color: var(--maroon-dark);
            font-size: 1.3rem;
            width: 30px;
            text-align: center;
        }

        .speakers {
            margin-top: 1rem;
        }

        .speakers-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--dark-gray);
            position: relative;
            padding-bottom: 0.5rem;
        }

        .speakers-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--blue-dark);
            border-radius: 1.5px;
        }

        .speakers-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .speaker {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 1.5rem;
            background: var(--light-gray);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .speaker:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            background: white;
        }

        .speaker-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--blue-dark) 100%);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.8rem;
            box-shadow: 0 5px 15px rgba(128, 0, 0, 0.2);
        }

        .speaker-name {
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }

        .speaker-title {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .event-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }

        /* Creative Categories Section */
        .categories {
            padding: 8rem 0;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .categories::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(128, 0, 0, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 0, 128, 0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .category-card {
            background: white;
            border: 1px solid var(--medium-gray);
            border-radius: 20px;
            padding: 3rem 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--blue-dark) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-strong);
            border-color: transparent;
        }

        .category-card:hover::before {
            opacity: 1;
        }

        .category-card:hover .category-icon,
        .category-card:hover .category-name {
            color: white;
        }

        .category-icon {
            font-size: 3rem;
            color: var(--maroon-dark);
            margin-bottom: 1.5rem;
            transition: all 0.4s ease;
        }

        .category-name {
            font-weight: 600;
            color: var(--dark-gray);
            font-size: 1.25rem;
            transition: all 0.4s ease;
        }

        /* Dynamic Upcoming Events - Creative Layout */
        .upcoming-events {
            padding: 8rem 0;
            background: var(--light-gray);
            position: relative;
        }

        .upcoming-events::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(45deg, transparent 49.5%, rgba(128, 0, 0, 0.03) 49.5%, rgba(128, 0, 0, 0.03) 50.5%, transparent 50.5%),
                linear-gradient(-45deg, transparent 49.5%, rgba(0, 0, 128, 0.03) 49.5%, rgba(0, 0, 128, 0.03) 50.5%, transparent 50.5%);
            background-size: 60px 60px;
            opacity: 0.5;
            pointer-events: none;
        }

        .events-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }

        .event-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: var(--shadow-soft);
            position: relative;
        }

        .event-card:hover {
            transform: translateY(-12px) rotateX(5deg);
            box-shadow: var(--shadow-strong);
        }

        .event-card-header {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .event-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .event-card:hover .event-card-image {
            transform: scale(1.1);
        }

        .event-card-badge {
            position: absolute;
            top: 1.2rem;
            left: 1.2rem;
            padding: 0.4rem 1rem;
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--blue-dark) 100%);
            color: white;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .event-card-content {
            padding: 2rem;
        }

        .event-card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 1.2rem;
            line-height: 1.3;
        }

        .event-card-meta {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
            margin-bottom: 1.8rem;
        }

        .event-card-meta-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .event-card-meta-icon {
            color: var(--maroon-dark);
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .event-card-cta {
            width: 100%;
        }

        /* Past Events - Creative Grid Layout */
        .past-events {
            padding: 8rem 0;
            background: white;
            position: relative;
        }

        .past-events-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }

        .past-event-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: var(--shadow-soft);
            position: relative;
        }

        .past-event-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-medium);
        }

        .past-event-image {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .past-event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: sepia(30%);
            transition: all 0.6s ease;
        }

        .past-event-card:hover .past-event-image img {
            filter: sepia(0%);
            transform: scale(1.05);
        }

        .past-event-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, transparent 60%, rgba(0, 0, 0, 0.7) 100%);
            display: flex;
            align-items: flex-end;
            justify-content: flex-start;
            padding: 1.5rem;
        }

        .past-event-status {
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--blue-dark) 100%);
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .past-event-content {
            padding: 2rem;
        }

        .past-event-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 0.7rem;
            line-height: 1.3;
        }

        .past-event-date {
            color: var(--maroon-dark);
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .past-event-date::before {
            content: '📅';
            font-size: 0.9rem;
        }

        .past-event-description {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Enhanced Footer with Creative Layout */
        .footer {
            background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
            padding: 6rem 0 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--maroon-dark), var(--blue-dark));
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 3.5rem;
            margin-bottom: 4rem;
            position: relative;
            z-index: 2;
        }

        .footer-column-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: white;
            margin-bottom: 1.8rem;
            position: relative;
            padding-bottom: 0.8rem;
        }

        .footer-column-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, var(--maroon-dark), var(--blue-dark));
            border-radius: 1.5px;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #ff6b6b 0%, #4ecdc4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1.5rem;
            display: block;
            text-decoration: none;
        }

        .footer-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 2rem;
        }

        .footer-social {
            display: flex;
            gap: 0.9rem;
        }

        .social-link {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .social-link:hover {
            background: linear-gradient(135deg, var(--maroon-dark) 0%, var(--blue-dark) 100%);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-link::before {
            content: '→';
            color: var(--maroon-dark);
            font-weight: bold;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-link:hover::before {
            opacity: 1;
            transform: translateX(0);
        }

        .footer-contact {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .contact-icon {
            color: var(--maroon-dark);
            font-size: 1.1rem;
            margin-top: 0.125rem;
            flex-shrink: 0;
        }

        .footer-bottom {
            padding-top: 2.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .copyright {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        .footer-legal {
            display: flex;
            gap: 2rem;
        }

        .legal-link {
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .legal-link::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--maroon-dark);
            transition: width 0.3s ease;
        }

        .legal-link:hover {
            color: white;
        }

        .legal-link:hover::after {
            width: 100%;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .event-grid {
                gap: 3rem;
            }
            
            .events-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 3rem;
            }
        }

        @media (max-width: 992px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .section-title {
                font-size: 2.5rem;
            }
            
            .event-grid {
                grid-template-columns: 1fr;
            }
            
            .event-image {
                min-height: 400px;
            }
            
            .categories-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .past-events-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .event-title {
                font-size: 2rem;
            }
            
            .categories-grid {
                grid-template-columns: 1fr;
            }
            
            .events-grid {
                grid-template-columns: 1fr;
            }
            
            .past-events-grid {
                grid-template-columns: 1fr;
            }
            
            .hero-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .nav-links {
                display: none;
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2.5rem;
            }
            
            .footer-bottom {
                flex-direction: column;
                gap: 1.5rem;
                text-align: center;
            }
            
            .footer-legal {
                flex-wrap: wrap;
                justify-content: center;
                gap: 1.5rem;
            }
            
            .container {
                padding: 0 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero {
                padding: 12rem 0 6rem;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .btn-primary, .btn-secondary {
                padding: 1rem 2rem;
                width: 100%;
                text-align: center;
            }
            
            .event-details {
                padding: 2rem;
            }
            
            .speakers-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Advanced Animations */
        @keyframes fadeInUp {
            from { 
                opacity: 0; 
                transform: translateY(40px) scale(0.95); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0) scale(1); 
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-fade-in {
            animation: fadeInUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse 3s ease-in-out infinite;
        }

        .gradient-animate {
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        /* Scroll Animation */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <header class="glass-effect premium-shadow border-b border-white/20 fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-primary-600 to-secondary-600 bg-clip-text text-transparent">Sibali.id</h1>
                </div>
                <nav class="flex space-x-8">
                    <a href="/" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Kenalan Yuk!</a>
                    <a href="/about" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Tentang kami</a>
                    <a href="/services" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Layanan kami</a>
                    <a href="/articles" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Pustaka</a>
                    <a href="/contact" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium">Hubungi Kami</a>

                    <!-- Info Lainnya Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = ! open" class="text-gray-600 hover:text-primary-600 transition-colors duration-200 font-medium flex items-center">
                            Info Lainnya
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                            <div class="py-1">
                                <a href="/sibalion-karyawan-kami" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sibalion! Karyawan kami!</a>
                                <a href="/kurikulum-sibali-id" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Kurikulum Sibali.id</a>
                                <a href="/event" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Event</a>
                                <a href="/investing-for-investor" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Investing for Investor!</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-background"></div>
        <div class="container">
            <div class="hero-content animate-fade-in">
                <div class="hero-badge animate-pulse-slow">AKSES EKSKLUSIF</div>
                <h1 class="hero-title">Event Premium</h1>
                <p class="hero-subtitle">Rasakan pengalaman networking dan pembelajaran yang tak tertandingi dalam kurasi event elite kami. Bergabunglah dengan komunitas eksklusif para visioner dan pemimpin.</p>
                <div class="hero-actions">
                    <button class="btn-primary gradient-animate">Jelajahi Event</button>
                    <button class="btn-secondary">Jadi Member</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Event -->
    <section class="featured-event">
        <div class="container">
            <div class="section-header animate-fade-in">
                <div class="section-badge">FEATURED EVENT</div>
                <h2 class="section-title">Elite Leadership Summit</h2>
                <p class="section-subtitle">An exclusive gathering of industry titans and visionary leaders. Limited to 50 VIP attendees only.</p>
            </div>
            <div class="event-grid">
                <div class="event-image reveal">
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=800&h=600&fit=crop&crop=center" alt="Elite Leadership Summit">
                </div>
                <div class="event-details reveal delay-100">
                    <h3 class="event-title">Transformational Leadership Experience</h3>
                    <div class="event-meta">
                        <div class="meta-item">
                            <span class="meta-icon">📅</span>
                            <span>April 15, 2024 - 9:00 AM - 6:00 PM</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-icon">📍</span>
                            <span>The Ritz-Carlton Jakarta</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-icon">👥</span>
                            <span>Capacity: 50 VIP Guests</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-icon">💰</span>
                            <span>Investment: $2,500 per person</span>
                        </div>
                    </div>
                    <div class="speakers">
                        <h4 class="speakers-title">Key Speakers</h4>
                        <div class="speakers-grid">
                            <div class="speaker">
                                <div class="speaker-avatar">SC</div>
                                <div class="speaker-name">Dr. Sarah Chen</div>
                                <div class="speaker-title">CEO, TechVision</div>
                            </div>
                            <div class="speaker">
                                <div class="speaker-avatar">MR</div>
                                <div class="speaker-name">Marcus Rodriguez</div>
                                <div class="speaker-title">Founder, InnoCorp</div>
                            </div>
                        </div>
                    </div>
                    <div class="event-actions">
                        <button class="btn-primary gradient-animate">Reserve VIP Seat</button>
                        <button class="btn-secondary">Download Agenda</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Event Categories -->
    <section class="categories">
        <div class="container">
            <div class="section-header animate-fade-in">
                <h2 class="section-title">Event Categories</h2>
                <p class="section-subtitle">Explore our diverse range of premium events</p>
            </div>
            <div class="categories-grid">
                <div class="category-card reveal animate-float">
                    <div class="category-icon">🎯</div>
                    <div class="category-name">Workshops</div>
                </div>
                <div class="category-card reveal delay-100">
                    <div class="category-icon">📚</div>
                    <div class="category-name">Seminars</div>
                </div>
                <div class="category-card reveal delay-200">
                    <div class="category-icon">🤝</div>
                    <div class="category-name">Networking</div>
                </div>
                <div class="category-card reveal delay-300">
                    <div class="category-icon">⭐</div>
                    <div class="category-name">VIP Events</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="upcoming-events">
        <div class="container">
            <div class="section-header animate-fade-in">
                <h2 class="section-title">Upcoming Events</h2>
                <p class="section-subtitle">Curated experiences designed for exceptional individuals</p>
            </div>
            <div class="events-grid">
                <!-- Event 1 -->
                <div class="event-card reveal">
                    <div class="event-card-header">
                        <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&h=250&fit=crop&crop=center" alt="Innovation Workshop" class="event-card-image">
                        <div class="event-card-badge">Workshop</div>
                    </div>
                    <div class="event-card-content">
                        <h3 class="event-card-title">Innovation Workshop</h3>
                        <div class="event-card-meta">
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">📅</span>
                                <span>Jan 15, 2024 - 10:00 AM</span>
                            </div>
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">📍</span>
                                <span>Online Event</span>
                            </div>
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">👥</span>
                                <span>Capacity: 100</span>
                            </div>
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">💰</span>
                                <span>$299 per person</span>
                            </div>
                        </div>
                        <button class="btn-primary event-card-cta gradient-animate">Secure Your Spot</button>
                    </div>
                </div>
                <!-- Event 2 -->
                <div class="event-card reveal delay-100">
                    <div class="event-card-header">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=250&fit=crop&crop=center" alt="Leadership Seminar" class="event-card-image">
                        <div class="event-card-badge">Seminar</div>
                    </div>
                    <div class="event-card-content">
                        <h3 class="event-card-title">Leadership Seminar</h3>
                        <div class="event-card-meta">
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">📅</span>
                                <span>Feb 20, 2024 - 2:00 PM</span>
                            </div>
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">📍</span>
                                <span>Jakarta Convention Center</span>
                            </div>
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">👥</span>
                                <span>Capacity: 200</span>
                            </div>
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">💰</span>
                                <span>$499 per person</span>
                            </div>
                        </div>
                        <button class="btn-primary event-card-cta gradient-animate">Reserve VIP Seat</button>
                    </div>
                </div>
                <!-- Event 3 -->
                <div class="event-card reveal delay-200">
                    <div class="event-card-header">
                        <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=400&h=250&fit=crop&crop=center" alt="Networking Mixer" class="event-card-image">
                        <div class="event-card-badge">Networking</div>
                    </div>
                    <div class="event-card-content">
                        <h3 class="event-card-title">Networking Mixer</h3>
                        <div class="event-card-meta">
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">📅</span>
                                <span>Mar 10, 2024 - 6:00 PM</span>
                            </div>
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">📍</span>
                                <span>Grand Ballroom Hotel</span>
                            </div>
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">👥</span>
                                <span>Capacity: 150</span>
                            </div>
                            <div class="event-card-meta-item">
                                <span class="event-card-meta-icon">💰</span>
                                <span>$199 per person</span>
                            </div>
                        </div>
                        <button class="btn-primary event-card-cta gradient-animate">Join the Elite</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Past Events -->
    <section class="past-events">
        <div class="container">
            <div class="section-header animate-fade-in">
                <h2 class="section-title">Past Events</h2>
                <p class="section-subtitle">Relive the success of our previous exclusive gatherings</p>
            </div>
            <div class="past-events-grid">
                <!-- Past Event 1 -->
                <div class="past-event-card reveal">
                    <div class="past-event-image">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400&h=250&fit=crop&crop=center" alt="Tech Summit 2023">
                        <div class="past-event-overlay">
                            <div class="past-event-status">Completed</div>
                        </div>
                    </div>
                    <div class="past-event-content">
                        <h3 class="past-event-title">Tech Summit 2023</h3>
                        <div class="past-event-date">December 2023</div>
                        <p class="past-event-description">300+ attendees, groundbreaking innovations showcased</p>
                    </div>
                </div>
                <!-- Past Event 2 -->
                <div class="past-event-card reveal delay-100">
                    <div class="past-event-image">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=400&h=250&fit=crop&crop=center" alt="Business Forum 2023">
                        <div class="past-event-overlay">
                            <div class="past-event-status">Completed</div>
                        </div>
                    </div>
                    <div class="past-event-content">
                        <h3 class="past-event-title">Business Forum 2023</h3>
                        <div class="past-event-date">November 2023</div>
                        <p class="past-event-description">200+ leaders, transformative discussions</p>
                    </div>
                </div>
                <!-- Past Event 3 -->
                <div class="past-event-card reveal delay-200">
                    <div class="past-event-image">
                        <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&h=250&fit=crop&crop=center" alt="Innovation Expo 2023">
                        <div class="past-event-overlay">
                            <div class="past-event-status">Completed</div>
                        </div>
                    </div>
                    <div class="past-event-content">
                        <h3 class="past-event-title">Innovation Expo 2023</h3>
                        <div class="past-event-date">October 2023</div>
                        <p class="past-event-description">500+ visitors, cutting-edge technologies displayed</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <a href="/" class="footer-logo">Sibali.id</a>
                    <p class="footer-description">Curating exclusive experiences for visionary leaders and innovators.</p>
                    <div class="footer-social">
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h4 class="footer-column-title">Tautan Cepat</h4>
                    <div class="footer-links">
                        <a href="/" class="footer-link">Beranda</a>
                        <a href="/about" class="footer-link">Tentang Kami</a>
                        <a href="/services" class="footer-link">Layanan</a>
                        <a href="/articles" class="footer-link">Artikel & Berita</a>
                        <a href="/contact" class="footer-link">Kontak</a>
                    </div>
                </div>
                <div class="footer-column">
                    <h4 class="footer-column-title">Layanan Kami</h4>
                    <div class="footer-links">
                        <a href="/services#bimbel" class="footer-link">Bimbingan Belajar</a>
                        <a href="/services#english" class="footer-link">Kursus Bahasa Inggris</a>
                        <a href="/simy" class="footer-link">SIMY</a>
                        <a href="/sitra" class="footer-link">SITRA</a>
                        <a href="/sintas" class="footer-link">SINTAS</a>
                    </div>
                </div>
                <div class="footer-column">
                    <h4 class="footer-column-title">Hubungi Kami</h4>
                    <div class="footer-contact">
                        <div class="contact-item">
                            <span class="contact-icon">📍</span>
                            <span>Jl. Contoh No. 123, Kota, Indonesia</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">📞</span>
                            <span>+62 123 4567 890</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">✉️</span>
                            <span>info@sibali.id</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="copyright">&copy; 2024 PT. Siap Belajar Indonesia (Sibali.id). All rights reserved.</div>
                <div class="footer-legal">
                    <a href="/privacy" class="legal-link">Kebijakan Privasi</a>
                    <a href="/terms" class="legal-link">Syarat & Ketentuan</a>
                    <a href="/cookies" class="legal-link">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Scroll animation
        window.addEventListener('scroll', function() {
            const reveals = document.querySelectorAll('.reveal');
            
            reveals.forEach(reveal => {
                const windowHeight = window.innerHeight;
                const revealTop = reveal.getBoundingClientRect().top;
                const revealPoint = 150;
                
                if (revealTop < windowHeight - revealPoint) {
                    reveal.classList.add('active');
                }
            });
        });

        // Initial trigger for animations
        window.dispatchEvent(new Event('scroll'));

        // Add hover effects to cards dynamically
        document.querySelectorAll('.event-card, .category-card, .past-event-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.zIndex = '10';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.zIndex = '1';
            });
        });

        // Button click effects
        document.querySelectorAll('.btn-primary, .btn-secondary, .nav-cta').forEach(button => {
            button.addEventListener('click', function(e) {
                // Ripple effect
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.7);
                    transform: scale(0);
                    animation: ripple-animation 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    top: ${y}px;
                    left: ${x}px;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple-animation {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>