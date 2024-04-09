$(document).ready(function() {
    $('#password').keyup(function() {
        $('#result').html(checkStrength($('#password').val()))
    })
    $('#dob').change(function() {
        console.log('dob changed')
        var dob = new Date($('#dob').val())
        var today = new Date()
        var age = today.getFullYear() - dob.getFullYear()
        var m = today.getMonth() - dob.getMonth()
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
            age--
        }
        if (age < 0) {
            $('#age').html('Invalid date')
            $('#submit').prop('disabled', true)
        }
        else if (age < 16) {
            $('#age').html('You must be at least 16 years old')
            $('#submit').prop('disabled', true)
        } else {
            $('#age').html('')
            $('#submit').prop('disabled', false)
        }
    })
    function checkStrength(password) {
        var strength = 0
        if (password.length < 6) {
            $('#result').removeClass()
            $('#result').addClass('short')
            $('#submit').prop('disabled', true)
            return 'Too short'
        }
        else $('#submit').prop('disabled', false)
        if (password.length > 7) strength += 1
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        if (strength < 2) {
            $('#result').removeClass()
            $('#result').addClass('weak')
            return 'Weak'
        } else if (strength == 2) {
            $('#result').removeClass()
            $('#result').addClass('good')
            return 'Good'
        } else {
            $('#result').removeClass()
            $('#result').addClass('strong')
            return 'Strong'
        }
    }
})