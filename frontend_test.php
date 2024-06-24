<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .article-container {
            width: 800px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        .article-header {
            position: relative;
        }
        .date-badge {
            position: absolute;
            bottom: -5px;
            left: 16px;
            background-color: #e60000;
            color: white;
            text-align: center;
            border-radius: 4px;
            padding: 10px 18px;
        }
        .date-day {
            display: block;
            font-size: 26px;
            font-weight: bold;
        }
        .date-month {
            display: block;
            font-size: 15px;
        }
        .article-image img {
            width: 100%;
            height: auto;
        }
        .article-content {
            padding: 16px;
        }
        .author {
            color: #666;
            font-size: 14px;
            margin: 0 0 8px;
        }
        .article-title {
            font-size: 24px;
            margin: 0 0 8px;
        }
        .article-description {
            font-size: 16px;
            margin: 0 0 16px;
        }
        .read-article {
            display: inline-block;
            padding: 8px 16px;
            background-color: #e60000;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        .read-article:hover {
            background-color: #ff3333;
            color: #fff5f5;
        }
        .pagination {
            display: flex;
            justify-content: center;
            padding: 16px;
            background-color: #f4f4f4;
        }
        .pagination a {
            margin: 0 4px;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .pagination a.active {
            background-color: #e60000;
            color: white;
            border-color: #e60000;
        }
    </style>
</head>
<body>
    <div id="app" class="article-container"></div>
    <script>
        const authors = [
            {
                "id": 1,
                "name": "Darwin Tumaneng",
                "role": "Logistics Digitalization Services Unit Representative",
                "place": "Metro Manila, Philippine",
                "avatar_url": "tmsph-logo.jpg"
            },
            {
                "id": 2,
                "name": "Miguel Tianzon",
                "role": "Car Rental Business Representative",
                "place": "Metro Manila, Philippine",
                "avatar_url": "tmsph-logo.jpg"
            }
        ];

        const news = [
            {
                "id": 1,
                "author_id": 1,
                "title": "Toyota Mobility Solutions PH empowers seafood wholesaler Mida Food with digital logistics platform",
                "body": "Logistics Platform addresses limitations in Mida Food's delivery operations",
                "image_url": "https://malaya.com.ph/wp-content/uploads/2023/01/w4.jpg",
                "created_at": "2023-01-13 12:30:00"
            },
            {
                "id": 2,
                "author_id": 2,
                "title": "TMSPH launches Toyota RentαCar",
                "body": "Toyota Mobility Solutions Philippines, Inc. (TMSPH) marked another milestone in its first year of operations with the introduction of its new and exciting car rental service, the Toyota RentαCar. This service provides affordable and secure transportation through its convenient and flexible car rental options – both for short-term and long-term use.",
                "image_url": "https://content.toyota.com.ph/uploads/articles/516/003_516_1684321968969_000.webp",
                "created_at": "2023-05-17 22:29:10"
            },
            {
                "id": 3,
                "author_id": 1,
                "title": "Toyota Motor Philippines partners with Lalamove Automotive",
                "body": "Leading mobility company Toyota Motor Philippines (TMP) has partnered with leading logistics provider Lalamove through its auto brand, Lalamove Automotive, with the introduction of the commercial vehicle Toyota Lite Ace as a transport partner. Aspiring and existing Lalamove operators are now able to purchase the Lite Ace Panel Van variant through this partnership, under Lalamove Automotive's Vehicle Ownership Program.",
                "image_url": "https://content.toyota.com.ph/uploads/articles/524/003_524_1687865880966_000.jpg",
                "created_at": "2023-07-05 02:15:01"
            }
        ];
        document.addEventListener('DOMContentLoaded', () => {
            const app = document.getElementById('app');
            const articlesPerPage = 1;
            let currentPage = 1;

            function getAuthorById(id) {
                return authors.find(author => author.id === id);
            }

            function renderArticle(article) {
                const author = getAuthorById(article.author_id);
                const date = new Date(article.created_at);
                const month = date.toLocaleString('default', { month: 'short' });
                const day = date.getDate();

                return `
                    <div class="article-header">
                        <div class="article-image">
                            <img src="${article.image_url}" alt="Article Image">
                            <div class="date-badge">
                                <span class="date-day">${day}</span>
                                <span class="date-month">${month.toUpperCase()}</span>
                            </div>
                        </div>
                    </div>
                    <div class="article-content">
                        <p class="author">${author.name}</p>
                        <h1 class="article-title">${article.title}</h1>
                        <p class="article-description">${article.body}</p>
                        <a class="read-article" href="#">READ ARTICLE</a>
                    </div>
                `;
            }

            function renderPagination() {
                const totalPages = Math.ceil(news.length / articlesPerPage);
                let paginationHtml = '<div class="pagination">';
                
                if (currentPage > 1) {
                    paginationHtml += `<a href="#" onclick="changePage(${currentPage - 1})">&#60;</a>`;
                }

                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml += `<a href="#" class="${i === currentPage ? 'active' : ''}" onclick="changePage(${i})">${i}</a>`;
                }

                if (currentPage < totalPages) {
                    paginationHtml += `<a href="#" onclick="changePage(${currentPage + 1})">&#62;</a>`;
                }
                
                paginationHtml += '</div>';
                return paginationHtml;
            }

            function render() {
                const startIndex = (currentPage - 1) * articlesPerPage;
                const endIndex = startIndex + articlesPerPage;
                const currentArticles = news.slice(startIndex, endIndex);

                app.innerHTML = currentArticles.map(renderArticle).join('') + renderPagination();
            }

            window.changePage = function(page) {
                currentPage = page;
                render();
            };

            render();
        });
    </script>
</body>
</html>
