<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV - {{ $cv['name'] }}</title>

    <style>
        /* ================= RESET & DASAR ================= */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 10.5pt;
            color: #000;
            line-height: 1.22;
            background-color: #525659; /* Nuansa PDF Reader / Viewer */
            margin: 0;
            padding: 0;
        }

        /* ================= TOOLBAR ATAS (PDF VIEWER) ================= */
        .pdf-toolbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #323639;
            color: #f1f1f1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-size: 13px;
        }

        .pdf-toolbar-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .pdf-toolbar-badge {
            background: #4a4f54;
            color: #d1d5db;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
        }

        .pdf-toolbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn-print {
            background: #2563eb;
            color: #ffffff;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.15s ease-in-out;
            font-family: inherit;
        }

        .btn-print:hover {
            background: #1d4ed8;
        }

        /* ================= CONTAINER LEMBAR A4 ================= */
        .pdf-container {
            padding: 24px 0 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 24px;
        }

        .a4-page {
            width: 210mm;
            min-height: 297mm;
            padding: 14mm 16mm;
            background: #ffffff;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.35);
            position: relative;
        }

        /* ================= STRUKTUR & KONTEN CV ================= */
        .header {
            text-align: center;
            margin-bottom: 12px;
        }

        .name {
            font-size: 21pt;
            font-weight: bold;
            margin-bottom: 3px;
            letter-spacing: 0.5px;
        }

        .contact {
            font-size: 10pt;
        }

        .address {
            margin-top: 3px;
            font-size: 10pt;
        }

        .section {
            margin-top: 10px;
        }

        .section-title {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 1.5px solid #555;
            padding-bottom: 2px;
            margin-bottom: 6px;
        }

        .summary {
            text-align: justify;
            text-justify: inter-word;
            font-size: 10.5pt;
        }

        .entry {
            margin-bottom: 6px;
            break-inside: avoid;
        }

        .entry-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 10px;
        }

        .period {
            font-weight: bold;
            white-space: nowrap;
            text-align: right;
            font-size: 10pt;
        }

        .subtitle {
            margin-top: 1px;
            font-size: 10pt;
        }

        ul {
            padding-left: 22px;
            margin: 2px 0 4px;
        }

        li {
            margin-bottom: 2px;
            text-align: justify;
            text-justify: inter-word;
            font-size: 10pt;
        }

        .skill-list {
            margin-top: 2px;
        }

        /* ================= SETUP CETAK / SIMPAN KE PDF ================= */
        @page {
            size: A4 portrait;
            margin: 0;
        }

        @media print {
            body {
                background: none !important;
                margin: 0 !important;
                padding: 0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .no-print {
                display: none !important;
            }

            .pdf-container {
                padding: 0 !important;
                gap: 0 !important;
                display: block !important;
            }

            .a4-page {
                box-shadow: none !important;
                margin: 0 !important;
                width: 210mm !important;
                min-height: 297mm !important;
                height: 297mm !important;
                padding: 14mm 16mm !important;
                page-break-after: always;
                break-after: page;
            }

            .a4-page:last-child {
                page-break-after: auto;
                break-after: auto;
            }
        }
    </style>
</head>

<body>

    {{-- TOP ACTION BAR (PDF VIEWER CONTROLS) --}}
    <div class="pdf-toolbar no-print">
        <div class="pdf-toolbar-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <span>CV - {{ $cv['name'] }}.pdf</span>
            <span class="pdf-toolbar-badge">A4 Portrait (2 Lembar)</span>
        </div>

        <div class="pdf-toolbar-actions">
            <button class="btn-print" onclick="window.print()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg>
                <span>Cetak / Simpan PDF</span>
            </button>
        </div>
    </div>

    {{-- CONTAINER KERTAS A4 --}}
    <div class="pdf-container">

        {{-- ================= LEMBAR 1 ================= --}}
        <div class="a4-page">

            {{-- HEADER --}}
            <header class="header">
                <div class="name">{{ $cv['name'] }}</div>

                <div class="contact">
                    {{ $cv['contact']['phone'] }} |
                    {{ $cv['contact']['email'] }} |
                    {{ $cv['contact']['linkedin'] }}
                </div>

                <div class="address">
                    {{ $cv['contact']['address'] }}
                </div>
            </header>

            {{-- SUMMARY --}}
            <section class="section">
                <div class="section-title">SUMMARY</div>
                <div class="summary">
                    {{ $cv['summary'] }}
                </div>
            </section>

            {{-- EDUCATION --}}
            <section class="section">
                <div class="section-title">EDUCATION</div>

                <ul>
                    @foreach ($cv['educations'] as $education)
                        <li>
                            <div class="entry-header">
                                <strong>{{ $education['institution'] }}</strong>
                                <strong class="period">{{ $education['period'] }}</strong>
                            </div>

                            @if ($education['degree'])
                                <div class="subtitle">
                                    {{ $education['degree'] }}
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </section>

            {{-- WORK EXPERIENCE --}}
            <section class="section">
                <div class="section-title">WORK EXPERIENCE</div>

                @foreach ($cv['experiences'] as $experience)
                    <div class="entry">
                        <strong>{{ $experience['position'] }}</strong>

                        <div class="subtitle">
                            {{ $experience['company'] }} |
                            {{ $experience['period'] }}
                        </div>

                        <ul>
                            @foreach ($experience['descriptions'] as $description)
                                <li>{{ $description }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </section>

            {{-- TECHNICAL TRAINING --}}
            <section class="section">
                <div class="section-title">TECHNICAL TRAINING</div>

                <ul>
                    @foreach ($cv['trainings'] as $training)
                        <li>
                            <strong>{{ $training['name'] }}</strong>

                            <div class="subtitle">
                                {{ $training['organization'] }} |
                                {{ $training['period'] }}
                            </div>

                            <ul>
                                @foreach ($training['descriptions'] as $description)
                                    <li>{{ $description }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </section>

            {{-- PROJECT --}}
            <section class="section">
                <div class="section-title">PROJECT</div>

                @foreach ($cv['projects'] as $project)
                    <div class="entry">
                        <div class="entry-header">
                            <strong>{{ $project['name'] }}</strong>
                            <strong class="period">{{ $project['period'] }}</strong>
                        </div>

                        <div class="subtitle">
                            <strong>{{ $project['role'] }}</strong>
                        </div>

                        <ul>
                            @foreach ($project['descriptions'] as $description)
                                <li>{{ $description }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </section>

        </div>

        {{-- ================= LEMBAR 2 ================= --}}
        <div class="a4-page">

            {{-- CERTIFICATION --}}
            <section class="section">
                <div class="section-title">CERTIFICATION</div>

                <ul>
                    @foreach ($cv['certifications'] as $certification)
                        <li>
                            <div class="entry-header">
                                <span>
                                    <strong>{{ $certification['name'] }}</strong>
                                    | {{ $certification['organization'] }}
                                </span>

                                <strong class="period">
                                    {{ $certification['period'] }}
                                </strong>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>

            {{-- TECHNICAL SKILLS --}}
            <section class="section">
                <div class="section-title">TECHNICAL SKILLS</div>

                <ul class="skill-list">
                    @foreach ($cv['technical_skills'] as $skill)
                        <li>
                            <strong>{{ $skill['category'] }}</strong>:
                            {{ $skill['skills'] }}
                        </li>
                    @endforeach
                </ul>
            </section>

            {{-- SOFT SKILLS --}}
            <section class="section">
                <div class="section-title">SOFT SKILLS</div>

                <ul>
                    @foreach ($cv['soft_skills'] as $skill)
                        <li>{{ $skill }}</li>
                    @endforeach
                </ul>
            </section>

        </div>

    </div>

</body>
</html>
