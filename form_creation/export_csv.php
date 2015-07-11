<?php
include 'database.php';
$pdo = Database::connect();
set_time_limit(0);
$excel_file_name = "Customer.xls";
$excel_file = "./".$excel_file_name;
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$excel_file_name);
header("Pragma: no-cache");
header("Expires: 0");
$handle = fopen($excel_file, "w");
$sel_st = "SELECT * FROM customers ORDER BY id DESC";
$i = 1;
$data_write = '
<table align="center" width="100%" cellspacing="0" cellpadding="2" border="0">
	<tr>
		<td colspan="100%" align="left" nowrap><h3>Customer List</h3></td>
	</tr>
	<tr>
		<td colspan="100%">
			<table width="100%" border="1" cellspacing="0" cellpadding="4" align="center">
				<tr bgcolor="#CCCCCC" height="25">
						<td align="center" nowrap><b>S. No.</b></td>
						<td align="left">Name</td>
						<td align="left">Email</td>
						<td align="left">Phone</td>
					</tr>';
                    foreach ($pdo->query($sel_st) as $row)
                    {
                        $data_write .= '
                            <tr height="25">
                                <td align="center">'.$i.'.</td>
                                <td align="left">'.$row['name'].'</td>
                                <td align="left">'.$row['email'].'</td>
                                <td align="left">'.$row['mobile'].'</td>
                            </tr>';
                        $i++;
                    }
                    $data_write .= '
			</table>
		</td>
	</tr>
</table>';
echo $data_write;
if (fwrite($handle, $data_write) === FALSE){
    echo "Cannot write to file ($filename)";
    exit;
}
fclose($handle);
?>