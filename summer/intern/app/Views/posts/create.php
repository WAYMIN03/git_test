<div style="text-align: center">
    <h1>Add New Post</h1>

    <form action="/PostController/store" enctype="multipart/form-data" method="POST">
        <h2>Post Title: </h2>
        <input name="title" type="text">
        <h2>Post Content: </h2>
        <textarea name="content" rows="4" cols="30"></textarea>
        <br>
        <div style="height:20px"></div>
        <button type="submit">Add New Post</button>
    </form>
</div>