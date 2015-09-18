<div class="content">
    <h1><?php echo $title; ?></h1>
    <?php $i = 1; ?>
    <?php if($listemployees): ?>
        <table>
            <thead>
	            <tr>
	                <th>No</th>
	                <th>User name</th>
	                <th>First name</th>
	                <th>Last name</th>
	                <th>Action</th>
	            </tr>
            </thead>
            <tbody>
            <?php foreach ($listemployees as $item): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo empty($item["username"]) ? "" : $item["username"]; ?></td>
                    <td><?php echo empty($item["firstname"]) ? "" : $item["firstname"]; ?></td>
                    <td><?php echo empty($item["lastname"]) ? "" : $item["lastname"]; ?></td>
                    <td><a href="<?php echo BASE_PATH; ?>employees/salary/<?php echo $item['id']; ?>">Salary calculation</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
