<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0; /* Tailwind reset */
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
                        "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans",
                        sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol",
                        "Noto Color Emoji";
            line-height: 1.5; /* default Tailwind line-height */
            font-feature-settings: "liga"; /* ligatures aan */
            text-size-adjust: 100%; /* browser text scaling */
            -webkit-font-smoothing: antialiased; /* voor betere rendering op webkit */
            -moz-osx-font-smoothing: grayscale; /* voor MacOS Firefox */
            background-color: white; /* in Tailwind wordt vaak gebruikt als default */
            color: #111827; /* default text kleur in Tailwind: gray-900 */
        }

        .max-w-2xl {
            max-width: 42rem /* 672px */;
        }

        .px-6 {
            padding-left: 1.5rem /* 24px */;
            padding-right: 1.5rem /* 24px */;
        }

        .py-8 {
            padding-top: 2rem /* 32px */;
            padding-bottom: 2rem /* 32px */;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .bg-gray-900 {
            background-color: #101828;
        }

        .block {
            display: block;
        }

        .h-9 {
            height: 2.25rem /* 36px */;
        }

        .w-auto {
            width: auto;
        }

        .fill-current {
            fill: currentColor;
        }

        .text-neutral-100 {
            color: #f7fafc;
        }

        .opacity-80 {
            opacity: 0.8;
        }

        .mt-4 {
            margin-top: 1rem /* 16px */;
        }

        .text-gray-200 {
            color: #edf2f7;
        }

        .mt-2 {
            margin-top: 0.5rem /* 8px */;
        }

        .leading-loose {
            line-height: 1.75;
        }

        .hover\:underline:hover {
            text-decoration: underline;
        }

        .text-blue-400 {
            color: #63b3ed;
        }

        .text-gray-400 {
            color: #99a1af;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .text-sm {
            font-size: 0.875rem /* 14px */;
            line-height: 1.25rem /* 20px */;
        }

        .mt-8 {
            margin-top: 2rem /* 32px */;
        }
    </style>
</head>
<body>
    <section class="max-w-2xl px-6 py-8 mx-auto bg-gray-900">
        <header>
            <span class="block h-9 text-sm w-auto fill-current text-neutral-100">
                NoedL<span class="opacity-80">.xyz</span>
            </span>

        </header>
        <main class="mt-4">
            <h2 class="text-gray-200">New Contact Form Submission</h2>

            <p><strong>Name:</strong> {{ $data['name'] ?? 'N/A' }}</p>
            <p><strong>Email:</strong> <a href="mailto:{{ $data['email'] }}" class="hover:underline text-blue-400">{{ $data['email'] }}</a></p>
            <p><strong>Message:</strong></p>
            <p>{!! nl2br(e($data['message'] ?? '')) !!}</p>
        </main>
    </section>
</body>
</html>
