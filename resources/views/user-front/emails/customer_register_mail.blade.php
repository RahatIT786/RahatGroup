<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <style>
        /* Importing a beautiful Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #58595b;
            margin: 0;
            padding: 50px 0;
            color: #333;
            /* background-image: url("{{ asset('assets/user-front/images/background-mail.jpeg') }}"); */

            /* background-image: url("https://rahatgroup.in/assets/user-front/images/background-mail.jpeg"); */
            background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAIuAVsDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwDs6KKK/kI/q0KKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigDwv/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYor+qP7Gyz/AKBof+AR/wAj+Zf7XzH/AKCZ/wDgcv8AM6f/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYoo/sbLP+gaH/gEf8g/tfMf+gmf/gcv8zp/+FleJP8AoI/+QIv/AImj/hZXiT/oI/8AkCL/AOJrmKKP7Gyz/oGh/wCAR/yD+18x/wCgmf8A4HL/ADOn/wCFleJP+gj/AOQIv/iaP+FleJP+gj/5Ai/+JrmKKP7Gyz/oGh/4BH/IP7XzH/oJn/4HL/M6f/hZXiT/AKCP/kCL/wCJo/4WV4k/6CP/AJAi/wDia5iij+xss/6Bof8AgEf8g/tfMf8AoJn/AOBy/wAzp/8AhZXiT/oI/wDkCL/4mj/hZXiT/oI/+QIv/ia5iij+xss/6Bof+AR/yD+18x/6CZ/+By/zOn/4WV4k/wCgj/5Ai/8AiaP+FleJP+gj/wCQIv8A4muYoo/sbLP+gaH/AIBH/IP7XzH/AKCZ/wDgcv8AM6f/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYoo/sbLP+gaH/gEf8g/tfMf+gmf/gcv8zp/+FleJP8AoI/+QIv/AImj/hZXiT/oI/8AkCL/AOJrmKKP7Gyz/oGh/wCAR/yD+18x/wCgmf8A4HL/ADOn/wCFleJP+gj/AOQIv/iaP+FleJP+gj/5Ai/+JrmKKP7Gyz/oGh/4BH/IP7XzH/oJn/4HL/M6f/hZXiT/AKCP/kCL/wCJo/4WV4k/6CP/AJAi/wDia5iij+xss/6Bof8AgEf8g/tfMf8AoJn/AOBy/wAzp/8AhZXiT/oI/wDkCL/4mj/hZXiT/oI/+QIv/ia5iij+xss/6Bof+AR/yD+18x/6CZ/+By/zOn/4WV4k/wCgj/5Ai/8AiaP+FleJP+gj/wCQIv8A4muYoo/sbLP+gaH/AIBH/IP7XzH/AKCZ/wDgcv8AM6f/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYoo/sbLP+gaH/gEf8g/tfMf+gmf/gcv8zp/+FleJP8AoI/+QIv/AImj/hZXiT/oI/8AkCL/AOJrmKKP7Gyz/oGh/wCAR/yD+18x/wCgmf8A4HL/ADOn/wCFleJP+gj/AOQIv/iaP+FleJP+gj/5Ai/+JrmKKP7Gyz/oGh/4BH/IP7XzH/oJn/4HL/M6f/hZXiT/AKCP/kCL/wCJo/4WV4k/6CP/AJAi/wDia5iij+xss/6Bof8AgEf8g/tfMf8AoJn/AOBy/wAzp/8AhZXiT/oI/wDkCL/4mj/hZXiT/oI/+QIv/ia5iij+xss/6Bof+AR/yD+18x/6CZ/+By/zOn/4WV4k/wCgj/5Ai/8AiaP+FleJP+gj/wCQIv8A4muYoo/sbLP+gaH/AIBH/IP7XzH/AKCZ/wDgcv8AM6f/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYoo/sbLP+gaH/gEf8g/tfMf+gmf/gcv8zp/+FleJP8AoI/+QIv/AImj/hZXiT/oI/8AkCL/AOJrmKKP7Gyz/oGh/wCAR/yD+18x/wCgmf8A4HL/ADOn/wCFleJP+gj/AOQIv/iaP+FleJP+gj/5Ai/+JrmKKP7Gyz/oGh/4BH/IP7XzH/oJn/4HL/MKKKK9g8kKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA//9k=);
            background-size: contain;
            background-repeat: repeat-x;
            background-position: top;

        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 0px;
            border-radius: 0px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;

        }
        .link a {
            display: inline-block;
            padding: 10px 20px;
            /* background-color: #3498db; */
            color: #221fe4;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 700;
        }
        .footer-link a {
            display: inline-block;
            color: #ffffff;
            text-decoration: none;
        }

        .footer {
            font-size: 12px;
            color: #999999;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div
        style="background-color: #f59933;background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCAIuAVsDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwDs6KKK/kI/q0KKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigDwv/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYor+qP7Gyz/AKBof+AR/wAj+Zf7XzH/AKCZ/wDgcv8AM6f/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYoo/sbLP+gaH/gEf8g/tfMf+gmf/gcv8zp/+FleJP8AoI/+QIv/AImj/hZXiT/oI/8AkCL/AOJrmKKP7Gyz/oGh/wCAR/yD+18x/wCgmf8A4HL/ADOn/wCFleJP+gj/AOQIv/iaP+FleJP+gj/5Ai/+JrmKKP7Gyz/oGh/4BH/IP7XzH/oJn/4HL/M6f/hZXiT/AKCP/kCL/wCJo/4WV4k/6CP/AJAi/wDia5iij+xss/6Bof8AgEf8g/tfMf8AoJn/AOBy/wAzp/8AhZXiT/oI/wDkCL/4mj/hZXiT/oI/+QIv/ia5iij+xss/6Bof+AR/yD+18x/6CZ/+By/zOn/4WV4k/wCgj/5Ai/8AiaP+FleJP+gj/wCQIv8A4muYoo/sbLP+gaH/AIBH/IP7XzH/AKCZ/wDgcv8AM6f/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYoo/sbLP+gaH/gEf8g/tfMf+gmf/gcv8zp/+FleJP8AoI/+QIv/AImj/hZXiT/oI/8AkCL/AOJrmKKP7Gyz/oGh/wCAR/yD+18x/wCgmf8A4HL/ADOn/wCFleJP+gj/AOQIv/iaP+FleJP+gj/5Ai/+JrmKKP7Gyz/oGh/4BH/IP7XzH/oJn/4HL/M6f/hZXiT/AKCP/kCL/wCJo/4WV4k/6CP/AJAi/wDia5iij+xss/6Bof8AgEf8g/tfMf8AoJn/AOBy/wAzp/8AhZXiT/oI/wDkCL/4mj/hZXiT/oI/+QIv/ia5iij+xss/6Bof+AR/yD+18x/6CZ/+By/zOn/4WV4k/wCgj/5Ai/8AiaP+FleJP+gj/wCQIv8A4muYoo/sbLP+gaH/AIBH/IP7XzH/AKCZ/wDgcv8AM6f/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYoo/sbLP+gaH/gEf8g/tfMf+gmf/gcv8zp/+FleJP8AoI/+QIv/AImj/hZXiT/oI/8AkCL/AOJrmKKP7Gyz/oGh/wCAR/yD+18x/wCgmf8A4HL/ADOn/wCFleJP+gj/AOQIv/iaP+FleJP+gj/5Ai/+JrmKKP7Gyz/oGh/4BH/IP7XzH/oJn/4HL/M6f/hZXiT/AKCP/kCL/wCJo/4WV4k/6CP/AJAi/wDia5iij+xss/6Bof8AgEf8g/tfMf8AoJn/AOBy/wAzp/8AhZXiT/oI/wDkCL/4mj/hZXiT/oI/+QIv/ia5iij+xss/6Bof+AR/yD+18x/6CZ/+By/zOn/4WV4k/wCgj/5Ai/8AiaP+FleJP+gj/wCQIv8A4muYoo/sbLP+gaH/AIBH/IP7XzH/AKCZ/wDgcv8AM6f/AIWV4k/6CP8A5Ai/+Jo/4WV4k/6CP/kCL/4muYoo/sbLP+gaH/gEf8g/tfMf+gmf/gcv8zp/+FleJP8AoI/+QIv/AImj/hZXiT/oI/8AkCL/AOJrmKKP7Gyz/oGh/wCAR/yD+18x/wCgmf8A4HL/ADOn/wCFleJP+gj/AOQIv/iaP+FleJP+gj/5Ai/+JrmKKP7Gyz/oGh/4BH/IP7XzH/oJn/4HL/MKKKK9g8kKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooA//9k=);
    background-size: contain;
    background-repeat: repeat-x;
    background-position: top; padding: 20px;">

        <div class="email-container">
            <div style="padding: 20px;">
                <div style="text-align: center;
            background-color: #ababab;">
                    <img alt="prophet-mosque" src="{{ asset('/assets/user-front/images/email_logo.png') }}" width="150px"
                         />
                </div>
                <h2>Dear {{ $customer->name }},</h2>
                <p>Thank you for signing up with Rahat Travels Of India Pvt. Ltd! </p>
                <p>We’re thrilled to have you as part of our community, and we’re committed to providing you with the
                    best
                    services to make your travel experience unforgettable.</p>
                <p>What You Can Expect: We’ll keep you updated with our latest deals, exclusive packages, and exciting
                    features.
                    Be sure to check them out to make the most of our tailored offers.</p>
                <p><strong>Your Registration Details:</strong></p>
                <p class="link"><strong>Email :</strong> {{ $customer->email }}</p>
                <p><strong>Password :</strong> {{ $mobile }}</p>
                <p>We look forward to assisting you in every way possible to help you achieve your travel goals.</p>
                <div style="margin-bottom: 0px !important;">Warm regards,</div>
                <p>{{ __('tablevars.Rahat Travels of India') }}</p>
            </div>
            <table style="background: #333333;width:100%;color:#ffffff;">
                <tr>
                    <td colspan='2' style="text-align: center; padding-top:20px;">Need More help? We are Here , Ready
                        to
                        Talk.</td>
                </tr>
                <tr>
                    <td style="text-align: right;width:50%;padding-right:20px;">

                        <p class="footer-link"><strong>Email :</strong> <a href="{{ $adminSetting }}" style="color: #ffffff">{{ $adminSetting }}</a></p>
                    </td>
                    <td style="width:50%;">
                        <p><strong>Phone :</strong> {{ $adminwhatsapp }}</p>
                    </td>
                </tr>
            </table>


        </div>
    </div>

</body>

</html>
