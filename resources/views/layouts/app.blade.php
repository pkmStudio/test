<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        aside {
            width: 400px;
            border-right: 1px solid #ccc;
            padding: 15px;
        }

        ul.categories {
            list-style-type: none;
            padding-left: 0;
        }

        ul.categories > li {
            margin-bottom: 10px;
        }

        ul.child-categories {
            display: none; /* Изначально скрываем списки */
        }

        ul.child-categories.visible {
            display: block; /* Показываем списки при наличии класса "visible" */
        }

        ul.categories li strong {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <aside>
        <h2>Категории</h2>
        <ul class="categories">
            @yield('aside')
        </ul>
    </aside>


    <div class="container-fluid p-3">
        @yield('content')
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.categories li strong');
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const sibling = this.nextElementSibling;
                if (sibling && sibling.tagName === 'UL') {
                    sibling.classList.toggle('visible'); // Добавляем/убираем класс "visible"
                }
            });
        });
    });

</script>
</body>
</html>
