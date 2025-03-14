<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FLYER LIST</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        img {
            max-width: 100%;
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
        }

        .header-image {
            width: 100%;
            height: 150px; /* Reduced header height */
            display: block;
            object-fit: cover;
        }

        .package-name {
            background: #2c3e50; /* Dark blue for a modern look */
            border-radius: 10px 10px 0 0;
            padding: 10px 20px;
            text-transform: uppercase;
            font-weight: 700;
            color: #ffffff;
            display: inline-block;
            min-width: 300px;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .package-table {
            width: 100%;
            border: 1px solid #ddd;
            text-align: center;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        .package-table thead {
            background: #3498db; /* Light blue for contrast */
            color: #ffffff;
            font-size: 14px;
        }

        .package-table th {
            padding: 12px;
            border: 1px solid #ddd;
            font-weight: 600;
        }

        .package-table td {
            border: 1px solid #ddd;
            padding: 10px;
            font-weight: 500;
        }

        .important-notes,
        .terms-conditions {
            padding: 0 10px 20px 20px;
            margin-bottom: 20px;
            text-align: left; /* Left-align text */
        }

        .important-notes div,
        .terms-conditions div {
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 14px;
            color: #2c3e50; /* Dark blue for headings */
        }

        .important-notes div {
            color: #e74c3c; /* Red for important notes */
        }

        .terms-conditions div {
            color: #27ae60; /* Green for terms and conditions */
        }

        .footer-image {
            width: 100%;
            height: 100px; /* Reduced footer height */
            display: block;
            object-fit: cover;
        }

        .section-divider {
            border: none;
            border-top: 2px solid #3498db; /* Light blue divider */
            margin: 20px 0;
        }

        .content-wrapper {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow for content */
        }

        .notes-terms-wrapper {
            display: flex;
            gap: 20px; /* Space between columns */
        }

        .notes-terms-wrapper td {
            vertical-align: top; /* Align content to the top */
        }
    </style>
</head>

<body>
    <div style="width:100%;">
        <!-- Header Section -->
        <div style="margin-bottom:20px;">
            <img src="{{ $headerImage }}" class="header-image" alt="Header Image" />
        </div>

        <!-- Packages Section -->
        <div class="content-wrapper">
            <table style="width:100%;" cellpadding="0px" cellspacing="0">
                <tbody>
                    @foreach ($packages as $key => $package)
                        @if ($key == 0 || $key % 2 == 0)
                            <tr>
                        @endif
                        <td width="50%" valign="top" style="padding:0px 0px 0px 0px;">
                            <div class="package-name">{{ $package->name }}</div>
                            <table class="package-table" cellpadding="5px" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th><strong>PACKAGE</strong></th>
                                        @foreach ($sharings as $sharing)
                                            <th><strong>{{ $sharing->name }}</strong></th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($package->pkgTypeNames as $typeName)
                                        <tr>
                                            <td><strong>{{ Helper::uppercase($typeName) }}</strong></td>
                                            @foreach ($sharings as $sharing)
                                                @php
                                                    $price = Helper::getPackagePrice($package->id, $typeName, $sharing->id);
                                                @endphp
                                                <td><strong>{{ $price }}</strong></td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        @if ($key == 1 || $key % 2 == 1)
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <!-- Divider -->
            <hr class="section-divider" />

            <!-- Notes and Terms Section -->
            @if (!empty($flyer->important_notes) || !empty($flyer->terms_cond))
                <div class="notes-terms-wrapper">
                    @if (!empty($flyer->important_notes))
                        <div class="important-notes">
                            <div>IMPORTANT NOTES</div>
                            {!! $flyer->important_notes !!}
                        </div>
                    @endif
                    @if (!empty($flyer->terms_cond))
                        <div class="terms-conditions">
                            <div>TERMS & CONDITIONS</div>
                            {!! $flyer->terms_cond !!}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Footer Section -->
        <div style="margin-top:20px;">
            <img src="{{ $footerImage }}" class="footer-image" alt="Footer Image" />
        </div>
    </div>
</body>

</html>
