<html>
<head>
    <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN'http:\/\/www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
    <title>Site</title>
</head>
<body>
    <h1>Query for gametrack</h1>
    <ul>
    <?php foreach ($query->result() as $row): ?>
        <li>
        <?php echo "ID=".$row->id." - MOVES=".$row->moves." - PLAYERS=".$row->players; ?>
        </li>
    <?php endforeach;?>
    </ul>
</body>
</html>

