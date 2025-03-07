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
            font-family: sans-serif;
            font-size: 16px;
            line-height: 1.2;
        }

        table {
            border-collapse: collapse;
        }

        table th {
            vertical-align: top;
        }

        @page {
            padding: 0px;
            margin: 0px;
        }
    </style>
</head>

<body>
    <div style="width:100%;">
        <div style="margin-bottom:10px;">
            <img src="{{ $headerImage }}" width="100%" height="434px" alt="img" />
        </div>
        <table style="width:100%;" cellpadding="0px" cellspacing="0">
            <tbody>
                @foreach ($packages as $key => $package)
                    @if ($key == 0 || $key % 2 == 0)
                        <tr>
                    @endif
                    <td width="50%" valign="top" style="padding:0px 10px 20px 20px;">
                        <div
                            style="background:#009746;border-radius:20px 20px 0px 0px;padding:8px 20px;text-transform:uppercase;font-weight:700;color:#ffffff;display:inline-block;min-width:387px;">
                            {{ $package->name }}</div>
                        <table style="width:100%; border: 1px solid #000000;text-align:center;" cellpadding="5px"
                            cellspacing="0">
                            <thead
                                style="background:#dbe282; border: 1px solid #000000;text-align:center;font-size:14px;">
                                <tr>
                                    <th
                                        style="border: 1px solid #000000;width:12.5%;background:#006636;color:#ffffff;font-style:italic;">
                                        <strong>PACKAGE</strong>
                                    </th>
                                    @foreach ($sharings as $sharing)
                                        <th style="border: 1px solid #000000;width:12.5%;font-style:italic;">
                                            <strong>{{ $sharing->name }}</strong>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($package->pkgTypeNames as $typeName)
                                    <tr>
                                        <td
                                            style="border: 1px solid #000000;background:#006636;color:#ffffff;font-style:italic;">
                                            <strong>{{ Helper::uppercase($typeName) }}</strong>
                                        </td>
                                        @foreach ($sharings as $sharing)
                                            @php
                                                $price = Helper::getPackagePrice($package->id, $typeName, $sharing->id);
                                            @endphp
                                            <td style="border: 1px solid #000000;">
                                                {{-- <strong>{{ $package->id }} --
                                                    {{ $typeName }}--{{ $sharing->id }} ||
                                                    {{ $price }}</strong> --}}
                                                <strong>{{ $price }}</strong>
                                            </td>
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
                <tr>
                    <td colspan="2" style="padding:0px 20px;">
                        <hr />
                    </td>
                </tr>
                @if (!empty($flyer->important_notes) || !empty($flyer->terms_cond))
                    <tr>
                        @if (!empty($flyer->important_notes))
                            <td width="50%" valign="top" style="padding:0px 10px 20px 20px;">
                                <div
                                    style="text-decoration:underline;font-weight:700;margin-bottom:8px;font-size: 14px;color:#000000;">
                                    IMPORTANT NOTES</div>
                                {!! $flyer->important_notes !!}
                            </td>
                        @endif
                        @if (!empty($flyer->terms_cond))
                            <td width="50%" valign="top" style="padding:0px 10px 20px 20px;">
                                <div
                                    style="text-decoration:underline;font-weight:700;margin-bottom:8px;font-size: 14px;color:#372d72;">
                                    TERMS & CONDITIONS</div>
                                {!! $flyer->terms_cond !!}
                            </td>
                        @endif
                    </tr>
                @endif
            </tbody>
        </table>

        <table style="width:100%;">
            <tbody>
                <tr>
                    <td height="220px" style="position: relative;"><img src="{{ $footerImage }}" width="100%"
                            height="192px" alt="img" style="position: absolute;left: 0px;bottom:0px;" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
