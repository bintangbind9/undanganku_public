<script>
    function dateTimeCustomFormat(pFormatString, pDate) {
        var result = pFormatString;
        var dateValue = new Date(pDate);
        var M3StrArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var M4StrArray=['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        if (pFormatString.includes('yyyy')) {
            result = result.replace('yyyy',dateValue.getFullYear());
        } else if (pFormatString.includes('yy')) {
            result = result.replace('yy',dateValue.getFullYear().toString().slice(-2));
        }

        if (pFormatString.includes('MMMM')) {
            result = result.replace('MMMM',M4StrArray[dateValue.getMonth()]);
        } else if (pFormatString.includes('MMM')) {
            result = result.replace('MMM',M3StrArray[dateValue.getMonth()]);
        } else if (pFormatString.includes('MM')) {
            result = result.replace('MM',('0' + (dateValue.getMonth() + 1)).slice(-2));
        } else if (pFormatString.includes('M')) {
            result = result.replace('M',dateValue.getMonth() + 1);
        }

        if (pFormatString.includes('dd')) {
            result = result.replace('dd',('0' + dateValue.getDate()).slice(-2));
        } else if (pFormatString.includes('d')) {
            result = result.replace('d',dateValue.getDate());
        }

        if (pFormatString.includes('hh')) {
            result = result.replace('hh',('0' + dateValue.getHours()).slice(-2));
        } else if (pFormatString.includes('h')) {
            result = result.replace('h',dateValue.getHours());
        }

        if (pFormatString.includes('mm')) {
            result = result.replace('mm',('0' + dateValue.getMinutes()).slice(-2));
        } else if (pFormatString.includes('m')) {
            result = result.replace('m',dateValue.getMinutes());
        }

        if (pFormatString.includes('ss')) {
            result = result.replace('ss',('0' + dateValue.getSeconds()).slice(-2));
        } else if (pFormatString.includes('s')) {
            result = result.replace('s',dateValue.getSeconds());
        }

        return result;
	}
</script>