<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <link rel="stylesheet" href="/styles/border.css">
        <link rel="stylesheet" href="/styles/inputW.css">
        <title>Lesson_9</title>
    </head>
    <body>
        <div class="m-3 bigBorder">
            <div class="form-group row m-2">
                <div class="m-3 text-center">
                    <div class="m-3 text-center border border-danger">
                        <p class="mb-3">Navigation:</p>
                        <button onclick="location.href='/category'" type="submit" class="btn btn-danger mb-3" name="button">list-categories</button>
                        <button onclick="location.href='/post'" type="submit" class="btn btn-danger mb-3" name="button">list-posts</button>
                        <button onclick="location.href='/tag'" type="submit" class="btn btn-danger mb-3" name="button">list-tags</button>
                    </div>
                </div>
            </div>
            @yield('list-categories')
            @yield('form-category')
            @yield('list-tags')
            @yield('form-tag')
            @yield('list-posts')
            @yield('form-post')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    </body>
</html>
