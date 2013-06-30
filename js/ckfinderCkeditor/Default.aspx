<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="Default.aspx.cs" Inherits="Myckeditor._Default" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head runat="server">
    <title>无标题页</title>
</head>
<body>
    <form id="form1" runat="server">
    
    
    
<script type="text/javascript"src="ckeditor/ckeditor.js"></script>
<script type="text/javascript"src="ckfinder/ckfinder.js"></script>

<asp:TextBox ID="TextBox1" runat="server" Rows="10" TextMode="MultiLine"></asp:TextBox>
<script type="text/javascript">CKEDITOR.replace('TextBox1')</script>



    </form>
</body>
</html>
