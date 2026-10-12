@once
    <style>
        .abstract-template-section {
            margin: 36px 0;
            padding: 28px;
            border: 1px solid #e8e8e4;
            border-radius: 16px;
            background: #fafaf8;
        }

        .abstract-template-inner {
            max-width: 1120px;
            margin: 0 auto;
        }

        .abstract-template-heading {
            margin-bottom: 20px;
        }

        .abstract-template-heading h2 {
            margin: 0 0 8px;
            font-size: clamp(22px, 3vw, 30px);
        }

        .abstract-template-heading p {
            max-width: 68ch;
            margin: 0;
            color: #5f6368;
        }

        .abstract-template-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 18px;
        }

        .abstract-template-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 9px 16px;
            border: 1px solid #d4d4cf;
            border-radius: 999px;
            color: #141413;
            background: #fff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .abstract-template-link:hover {
            border-color: #141413;
        }

        .abstract-template-link--primary {
            border-color: #141413;
            color: #fff;
            background: #141413;
        }

        .abstract-template-link--primary:hover {
            color: #fff;
            background: #333;
        }

        .abstract-template-preview {
            overflow: hidden;
            border: 1px solid #d4d4cf;
            border-radius: 10px;
            background: #fff;
        }

        .abstract-template-preview iframe {
            display: block;
            width: 100%;
            height: min(78vh, 760px);
            min-height: 480px;
            border: 0;
        }

        .abstract-template-fallback {
            padding: 12px 16px;
            margin: 0;
            border-top: 1px solid #e8e8e4;
            color: #5f6368;
            font-size: 13px;
        }

        .abstract-template-fallback a {
            color: inherit;
        }

        @media (max-width: 640px) {
            .abstract-template-section {
                padding: 20px 16px;
            }

            .abstract-template-preview iframe {
                height: 70vh;
                min-height: 420px;
            }

            .abstract-template-link {
                flex: 1 1 100%;
            }
        }
    </style>
@endonce

<section class="abstract-template-section" aria-labelledby="abstract-template-title">
    <div class="abstract-template-inner">
        <div class="abstract-template-heading">
            <h2 id="abstract-template-title">Abstract instructions &amp; template</h2>
            <p>Review the submission instructions and prepare your abstract using the conference template. You can preview it below or download a copy.</p>
        </div>

        <div class="abstract-template-actions">
            <a class="abstract-template-link abstract-template-link--primary" href="{{ asset('downloads/sai-meche-conference-abstract-template.docx') }}" download>
                Download Word template
            </a>
            <a class="abstract-template-link" href="{{ asset('downloads/sai-meche-conference-abstract-template-preview.html') }}" target="_blank" rel="noopener noreferrer">
                Open full preview
            </a>
        </div>

        <div class="abstract-template-preview">
            <iframe
                src="{{ asset('downloads/sai-meche-conference-abstract-template-preview.html') }}"
                title="Preview of the SAIMechE conference abstract instructions and template"
                loading="lazy">
            </iframe>
            <p class="abstract-template-fallback">
                If the preview does not appear in your browser,
                <a href="{{ asset('downloads/sai-meche-conference-abstract-template-preview.html') }}" target="_blank" rel="noopener noreferrer">open the full preview in a new tab</a>.
            </p>
        </div>
    </div>
</section>
