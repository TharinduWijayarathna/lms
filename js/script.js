function admin_login() {
  var username = document.getElementById("adminus").value;
  var password = document.getElementById("adminpw").value;
  var remember = document.getElementById("remember").checked;
  var errortext = document.getElementById("errortext");

  var form = new FormData();
  form.append("username", username);
  form.append("password", password);
  form.append("remember", remember);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "Success") {
        window.location = "admin_dashboard.php";
      } else {
        errortext.innerHTML = text;
        errortext.classList = "text-danger";
      }
    }
  };
  r.open("POST", "admin_login_process.php", true);
  r.send(form);
}

function admin_action(x) {
  var btn = document.getElementById("actionbtn" + x);
  var admin_id = x;

  var form = new FormData();

  form.append("adminid", admin_id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        btn.classList = "btn btn-inverse-success col-12";
        btn.innerHTML = "Active";
      } else if (text == 2) {
        btn.classList = "btn btn-inverse-danger col-12";
        btn.innerHTML = "Deactive";
      } else {
      }
    }
  };
  r.open("POST", "admin_status_change.php", true);
  r.send(form);
}

function delete_admin(x) {
  var admin_id = x;

  var form = new FormData();

  form.append("adminid", admin_id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("done");
        window.location = "manage_admins.php";
      } else {
      }
    }
  };
  r.open("POST", "delete_admins.php", true);
  r.send(form);
}

function addadmin() {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var gender = document.getElementById("gender").value;
  var email = document.getElementById("email").value;
  var username = document.getElementById("username").value;
  var password1 = document.getElementById("pw").value;
  var password2 = document.getElementById("rpw").value;
  var textalert = document.getElementById("alert");

  var form = new FormData();

  form.append("fname", fname);
  form.append("lname", lname);
  form.append("gender", gender);
  form.append("email", email);
  form.append("username", username);
  form.append("password1", password1);
  form.append("password2", password2);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("done");
        window.location = "manage_admins.php";
      } else if (text == 2) {
        window.location = "admin_login.php";
      } else {
        textalert.innerHTML = text;
      }
    }
  };
  r.open("POST", "add_admin_process.php", true);
  r.send(form);
}

function addteachers() {
  var fname = document.getElementById("tfname").value;
  var lname = document.getElementById("tlname").value;
  var username = document.getElementById("tusername").value;
  var email = document.getElementById("temail").value;
  var gender = document.getElementById("tgender").value;
  var password1 = document.getElementById("tpw").value;
  var password2 = document.getElementById("trpw").value;
  var textalert = document.getElementById("talert");

  var form = new FormData();
  form.append("fname", fname);
  form.append("lname", lname);
  form.append("gender", gender);
  form.append("email", email);
  form.append("username", username);
  form.append("password1", password1);
  form.append("password2", password2);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        textalert.innerHTML = "";
        alert("done");

        document.getElementById("tfname").value = "";
        document.getElementById("tlname").value = "";
        document.getElementById("tusername").value = "";
        document.getElementById("temail").value = "";
        document.getElementById("tpw").value = "";
        document.getElementById("trpw").value = "";
        document.getElementById("talert").value = "";
      } else if (text == 2) {
        window.location = "admin_login.php";
      } else {
        textalert.innerHTML = text;
      }
    }
  };
  r.open("POST", "add_teachers_process.php", true);
  r.send(form);
}

function teacherfields() {
  document.getElementById("tfname").value = "";
  document.getElementById("tlname").value = "";
  document.getElementById("tusername").value = "";
  document.getElementById("temail").value = "";
  document.getElementById("tpw").value = "";
  document.getElementById("trpw").value = "";
}

function addofficers() {
  var fname = document.getElementById("afname").value;
  var lname = document.getElementById("alname").value;
  var username = document.getElementById("ausername").value;
  var email = document.getElementById("aemail").value;
  var gender = document.getElementById("agender").value;
  var password1 = document.getElementById("apw").value;
  var password2 = document.getElementById("arpw").value;
  var textalert = document.getElementById("aalert");

  var form = new FormData();
  form.append("fname", fname);
  form.append("lname", lname);
  form.append("gender", gender);
  form.append("email", email);
  form.append("username", username);
  form.append("password1", password1);
  form.append("password2", password2);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        textalert.innerHTML = "";

        alert("done");

        document.getElementById("afname").value = "";
        document.getElementById("alname").value = "";
        document.getElementById("ausername").value = "";
        document.getElementById("aemail").value = "";
        document.getElementById("apw").value = "";
        document.getElementById("arpw").value = "";
      } else if (text == 2) {
        window.location = "admin_login.php";
      } else {
        textalert.innerHTML = text;
      }
    }
  };
  r.open("POST", "add_officers_process.php", true);
  r.send(form);
}

function officerfields() {
  document.getElementById("afname").value = "";
  document.getElementById("alname").value = "";
  document.getElementById("ausername").value = "";
  document.getElementById("aemail").value = "";
  document.getElementById("apw").value = "";
  document.getElementById("arpw").value = "";
}

function teacher_action(x) {
  var btn = document.getElementById("actionbtn" + x);
  var teacher_id = x;

  var form = new FormData();

  form.append("tid", teacher_id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        btn.classList = "btn btn-inverse-success col-12";
        btn.innerHTML = "Active";
      } else if (text == 2) {
        btn.classList = "btn btn-inverse-danger col-12";
        btn.innerHTML = "Deactive";
      } else {
      }
    }
  };
  r.open("POST", "teachers_status_change.php", true);
  r.send(form);
}

function delete_teacher(x) {
  var teacher_id = x;

  var form = new FormData();

  form.append("tid", teacher_id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("done");
        window.location = "manage_teachers.php";
      } else {
      }
    }
  };
  r.open("POST", "delete_teachers.php", true);
  r.send(form);
}

function teacher_search() {
  var search_text = document.getElementById("tsearch").value;
  var table = document.getElementById("insidetable");

  var form = new FormData();

  form.append("text", search_text);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      table.innerHTML = text;
    }
  };
  r.open("POST", "search_teachers.php", true);
  r.send(form);
}

function officer_action(x) {
  var btn = document.getElementById("actionbtn" + x);
  var officer_id = x;

  var form = new FormData();

  form.append("aid", officer_id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        btn.classList = "btn btn-inverse-success col-12";
        btn.innerHTML = "Active";
      } else if (text == 2) {
        btn.classList = "btn btn-inverse-danger col-12";
        btn.innerHTML = "Deactive";
      } else {
      }
    }
  };
  r.open("POST", "officer_status_change.php", true);
  r.send(form);
}

function delete_officer(x) {
  var officer_id = x;

  var form = new FormData();

  form.append("aid", officer_id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("done");
        window.location = "manage_officers.php";
      } else {
      }
    }
  };
  r.open("POST", "delete_officers.php", true);
  r.send(form);
}

function officer_search() {
  var search_text = document.getElementById("tsearch").value;
  var table = document.getElementById("insidetable");

  var form = new FormData();

  form.append("text", search_text);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      table.innerHTML = text;
    }
  };
  r.open("POST", "search_officers.php", true);
  r.send(form);
}

function student_action(x) {
  var btn = document.getElementById("actionbtn" + x);
  var student_id = x;

  var form = new FormData();

  form.append("sid", student_id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        btn.classList = "btn btn-inverse-success col-12";
        btn.innerHTML = "<i class='ti-check'></i>";
      } else if (text == 2) {
        btn.classList = "btn btn-inverse-danger col-12";
        btn.innerHTML = "<i class='ti-close'></i>";
      } else {
      }
    }
  };
  r.open("POST", "student_status_change.php", true);
  r.send(form);
}

function delete_student(x) {
  var student_id = x;

  var form = new FormData();

  form.append("sid", student_id);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("done");
        window.location = "manage_students.php";
      } else {
      }
    }
  };
  r.open("POST", "delete_students.php", true);
  r.send(form);
}

function student_search() {
  var search_text = document.getElementById("tsearch").value;
  var table = document.getElementById("insidetable");

  var form = new FormData();

  form.append("text", search_text);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      table.innerHTML = text;
    }
  };
  r.open("POST", "search_students.php", true);
  r.send(form);
}

function changeimage() {
  var image = document.getElementById("imgupload");
  var view = document.getElementById("imageload");

  image.onchange = function () {
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    view.src = url;
  };
}

function update_admin() {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var gender = document.getElementById("gender").value;
  var email = document.getElementById("email").value;
  var username = document.getElementById("username").value;
  var password1 = document.getElementById("pw").value;
  var password2 = document.getElementById("rpw").value;
  var textalert = document.getElementById("alert");
  var image = document.getElementById("imgupload");

  var form = new FormData();

  form.append("fname", fname);
  form.append("lname", lname);
  form.append("gender", gender);
  form.append("email", email);
  form.append("username", username);
  form.append("password1", password1);
  form.append("password2", password2);

  if (image.files.length > 1) {
    alert("Please select one image");
  } else {
    form.append("img", image.files[0]);
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        window.location = "update_admin_profile.php";
      } else if (text == 2) {
        window.location = "admin_login.php";
      } else {
        textalert.innerHTML = text;
      }
    }
  };
  r.open("POST", "update_admin_process.php", true);
  r.send(form);
}

function unassign_teachers(x) {
  var teacher_id = x;
  var grade_id = document.getElementById("grade_id" + x).value;
  var subject_id = document.getElementById("subject_id" + x).value;

  var form = new FormData();

  form.append("teacher_id", teacher_id);
  form.append("grade_id", grade_id);
  form.append("subject_id", subject_id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        window.location = "assign_teachers_for_subjects.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "unassign_teachers_from_subjects.php", true);
  r.send(form);
}

function teacher_assign_search() {
  var search_text = document.getElementById("tsearch").value;
  var table = document.getElementById("insidetable");

  var form = new FormData();

  form.append("text", search_text);
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      table.innerHTML = text;
    }
  };
  r.open("POST", "search_assign_teacher.php", true);
  r.send(form);
}

function assign_teacher() {
  var teacher_id = document.getElementById("teacher_id").value;
  var grade_id = document.getElementById("grade_id").value;
  var subject_id = document.getElementById("subject_id").value;

  var form = new FormData();

  form.append("teacher_id", teacher_id);
  form.append("grade_id", grade_id);
  form.append("subject_id", subject_id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("done");
        window.location = "assign_teachers_for_subjects.php";
      } else if (text == 2) {
        alert("Already Assigned");
      } else {
        window.location = "admin_login.php";
      }
    }
  };
  r.open("POST", "add_new_teacher_subject_assign.php", true);
  r.send(form);
}
function teacher_login() {
  var username = document.getElementById("teacherus").value;
  var password = document.getElementById("teacherpw").value;
  var remember = document.getElementById("remember").checked;
  var errortext = document.getElementById("errortext");

  var form = new FormData();
  form.append("username", username);
  form.append("password", password);
  form.append("remember", remember);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "Success") {
        window.location = "teacher_dashboard.php";
      } else if (text == 1) {
        var m = document.getElementById("verify");
        k = new bootstrap.Modal(m);
        k.show();
      } else {
        errortext.innerHTML = text;
        errortext.classList = "text-danger";
      }
    }
  };
  r.open("POST", "teacher_login_process.php", true);
  r.send(form);
}

function teacher_verify() {
  var username = document.getElementById("teacherus").value;
  var password = document.getElementById("teacherpw").value;
  var code = document.getElementById("code").value;

  var form = new FormData();
  form.append("username", username);
  form.append("password", password);
  form.append("code", code);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        k.hide();
        var s = document.getElementById("verify_done");
        x = new bootstrap.Modal(s);
        x.show();
      } else {
        alert(text);
      }
    }
  };

  r.open("POST", "teacher_code_verify.php", true);
  r.send(form);
}
function lesson_notes(x) {
  var subject_id = document.getElementById("subid" + x).value;
  var grade_id = document.getElementById("gradeid" + x).value;
  var doc = document.getElementById("notes" + x);
  var description = document.getElementById("desc" + x).value;

  var form = new FormData();

  if (doc.files.length > 1) {
    alert("Please select one file");
  } else {
    form.append("file", doc.files[0]);
  }

  form.append("subject", subject_id);
  form.append("grade", grade_id);
  form.append("desc", description);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "add_lesson_notes.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "add_lesson_notes_process.php", true);
  r.send(form);
}

function removenotes(x) {
  var subject_id = document.getElementById("subid" + x).value;
  var grade_id = document.getElementById("gradeid" + x).value;
  var teacher = document.getElementById("teachersid" + x).value;

  var form = new FormData();
  form.append("subject", subject_id);
  form.append("grade", grade_id);
  form.append("teacher", teacher);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "add_lesson_notes.php";
      } else {
        alert("Error");
      }
    }
  };
  r.open("POST", "remove_notes_process.php", true);
  r.send(form);
}

function new_lesson_notes() {
  var subject_id = document.getElementById("subid").value;
  var grade_id = document.getElementById("gradeid").value;
  var doc = document.getElementById("notes");
  var description = document.getElementById("desc").value;

  var form = new FormData();

  if (doc.files.length > 1) {
    alert("Please select one file");
  } else {
    form.append("file", doc.files[0]);
  }

  form.append("subject", subject_id);
  form.append("grade", grade_id);
  form.append("desc", description);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "add_lesson_notes.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "add_new_lesson_notes_process.php", true);
  r.send(form);
}

function changesubicon(x) {
  var label = document.getElementById("substatus" + x);

  label.classList = "badge badge-warning col-12";
  label.innerHTML = "New Files Selected";
}

function dateload(x) {
  var m = document.getElementById("dateset" + x);
  k = new bootstrap.Modal(m);
  k.show();
}

function assignmets(x) {
  var subject_id = document.getElementById("subid" + x).value;
  var grade_id = document.getElementById("gradeid" + x).value;
  var doc = document.getElementById("notes" + x);
  var teacher = document.getElementById("teachersid" + x).value;
  var description = document.getElementById("desc" + x).value;
  var start_date = document.getElementById("startdate" + x).value;
  var last_date = document.getElementById("lastdate" + x).value;

  var form = new FormData();

  if (doc.files.length > 1) {
    alert("Please select one file");
  } else {
    form.append("file", doc.files[0]);
  }

  form.append("subject", subject_id);
  form.append("grade", grade_id);
  form.append("teacher", teacher);
  form.append("desc", description);
  form.append("start_date", start_date);
  form.append("last_date", last_date);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "add_new_assignments.php";
      } else if (text == 2) {
        alert("Please add your assignment");
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "add_assignment_process.php", true);
  r.send(form);
}

function remove_assignment(x) {
  var subject_id = document.getElementById("subid" + x).value;
  var grade_id = document.getElementById("gradeid" + x).value;
  var teacher = document.getElementById("teachersid" + x).value;

  var form = new FormData();
  form.append("subject", subject_id);
  form.append("grade", grade_id);
  form.append("teacher", teacher);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "add_new_assignments.php";
      } else {
        alert("Error");
      }
    }
  };
  r.open("POST", "remove_assignments_process.php", true);
  r.send(form);
}

function student_login() {
  var nic = document.getElementById("studentus").value;
  var password = document.getElementById("studentpw").value;
  var remember = document.getElementById("remember").checked;
  var errortext = document.getElementById("errortext");

  var form = new FormData();
  form.append("nic", nic);
  form.append("password", password);
  form.append("remember", remember);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "Success") {
        window.location = "student_dashboard.php";
      } else if (text == 1) {
        var m = document.getElementById("verify");
        k = new bootstrap.Modal(m);
        k.show();
      } else if (text == 2) {
        window.location = "student_payment.php";
      } else if (text == 3) {
        var n = document.getElementById("notify");
        u = new bootstrap.Modal(n);
        u.show();
      } else {
        errortext.innerHTML = text;
        errortext.classList = "text-danger";
      }
    }
  };
  r.open("POST", "student_login_process.php", true);
  r.send(form);
}

function student_verify() {
  var nic = document.getElementById("studentus").value;
  var password = document.getElementById("studentpw").value;
  var code = document.getElementById("code").value;

  var form = new FormData();
  form.append("nic", nic);
  form.append("password", password);
  form.append("code", code);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        k.hide();
        var s = document.getElementById("verify_done");
        x = new bootstrap.Modal(s);
        x.show();
      } else {
        alert(text);
      }
    }
  };

  r.open("POST", "student_code_verify.php", true);
  r.send(form);
}

function update_teacher() {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var gender = document.getElementById("gender").value;
  var email = document.getElementById("email").value;
  var username = document.getElementById("username").value;
  var password1 = document.getElementById("pw").value;
  var password2 = document.getElementById("rpw").value;
  var textalert = document.getElementById("alert");
  var image = document.getElementById("imgupload");

  var form = new FormData();

  form.append("fname", fname);
  form.append("lname", lname);
  form.append("gender", gender);
  form.append("email", email);
  form.append("username", username);
  form.append("password1", password1);
  form.append("password2", password2);

  if (image.files.length > 1) {
    alert("Please select one image");
  } else {
    form.append("img", image.files[0]);
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        window.location = "update_teachers_profile.php";
      } else if (text == 2) {
        window.location = "teacher_login.php";
      } else {
        textalert.innerHTML = text;
      }
    }
  };
  r.open("POST", "update_teacher_process.php", true);
  r.send(form);
}

function update_student() {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var gender = document.getElementById("gender").value;
  var email = document.getElementById("email").value;
  var password1 = document.getElementById("pw").value;
  var password2 = document.getElementById("rpw").value;
  var textalert = document.getElementById("alert");
  var image = document.getElementById("imgupload");

  var form = new FormData();

  form.append("fname", fname);
  form.append("lname", lname);
  form.append("gender", gender);
  form.append("email", email);
  form.append("password1", password1);
  form.append("password2", password2);

  if (image.files.length > 1) {
    alert("Please select one image");
  } else {
    form.append("img", image.files[0]);
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        window.location = "update_student_profile.php";
      } else if (text == 2) {
        window.location = "student_login.php";
      } else {
        textalert.innerHTML = text;
      }
    }
  };
  r.open("POST", "update_student_process.php", true);
  r.send(form);
}
function add_new_assignmets() {
  var subject_id = document.getElementById("subid").value;
  var grade_id = document.getElementById("gradeid").value;
  var doc = document.getElementById("notes");
  var description = document.getElementById("desc").value;
  var start_date = document.getElementById("startdate").value;
  var last_date = document.getElementById("lastdate").value;

  var form = new FormData();

  if (doc.files.length > 1) {
    alert("Please select one file");
  } else {
    form.append("file", doc.files[0]);
  }

  form.append("subject", subject_id);
  form.append("grade", grade_id);
  form.append("desc", description);
  form.append("start_date", start_date);
  form.append("last_date", last_date);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "add_new_assignments.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "add_new_assignment_process.php", true);
  r.send(form);
}

function payment_data() {
  var nic = document.getElementById("nic").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("pw").value;

  var form = new FormData();

  form.append("nic", nic);
  form.append("email", email);
  form.append("password", password);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "paynow.php";
      } else if (text == 2) {
        alert("Already Paid for this year");
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "payment_user_data.php", true);
  r.send(form);
}

function upload_answer(x) {
  var answer = document.getElementById("answer" + x);
  var assignment_id = x;

  var form = new FormData();
  form.append("assignment", assignment_id);

  if (answer.files.length > 1) {
    alert("Please select one file");
  } else {
    form.append("file", answer.files[0]);
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "upload_assignment.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "upload_assignment_answer_process.php", true);
  r.send(form);
}

function viewed_status(x) {
  var status = 1;

  var form = new FormData();
  form.append("id", x);
  form.append("status", status);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "view_submitted_answer_sheets.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "answer_sheets_status_change.php", true);
  r.send(form);
}

function not_viewed_status(x) {
  var status = 2;

  var form = new FormData();
  form.append("id", x);
  form.append("status", status);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "view_submitted_answer_sheets.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "answer_sheets_status_change.php", true);
  r.send(form);
}

function add_or_change_marks(x) {
  var marks = document.getElementById("marks" + x).value;
  var id = x;

  var form = new FormData();
  form.append("marks", marks);
  form.append("id", id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "add_assignment_marks.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "add_or_change_marks.php", true);
  r.send(form);
}

function officer_login() {
  var username = document.getElementById("officerus").value;
  var password = document.getElementById("officerpw").value;
  var remember = document.getElementById("remember").checked;
  var errortext = document.getElementById("errortext");

  var form = new FormData();
  form.append("username", username);
  form.append("password", password);
  form.append("remember", remember);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == "Success") {
        window.location = "academic_officer_dashboard.php";
      } else if (text == 1) {
        var m = document.getElementById("verify");
        k = new bootstrap.Modal(m);
        k.show();
      } else {
        errortext.innerHTML = text;
        errortext.classList = "text-danger";
      }
    }
  };
  r.open("POST", "academic_login_process.php", true);
  r.send(form);
}

function officer_verify() {
  var username = document.getElementById("officerus").value;
  var password = document.getElementById("officerpw").value;
  var code = document.getElementById("code").value;

  var form = new FormData();
  form.append("username", username);
  form.append("password", password);
  form.append("code", code);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        k.hide();
        var s = document.getElementById("verify_done");
        x = new bootstrap.Modal(s);
        x.show();
      } else {
        alert(text);
      }
    }
  };

  r.open("POST", "academic_code_verify.php", true);
  r.send(form);
}

function update_officer() {
  var fname = document.getElementById("fname").value;
  var lname = document.getElementById("lname").value;
  var gender = document.getElementById("gender").value;
  var email = document.getElementById("email").value;
  var username = document.getElementById("username").value;
  var password1 = document.getElementById("pw").value;
  var password2 = document.getElementById("rpw").value;
  var textalert = document.getElementById("alert");
  var image = document.getElementById("imgupload");

  var form = new FormData();

  form.append("fname", fname);
  form.append("lname", lname);
  form.append("gender", gender);
  form.append("email", email);
  form.append("username", username);
  form.append("password1", password1);
  form.append("password2", password2);

  if (image.files.length > 1) {
    alert("Please select one image");
  } else {
    form.append("img", image.files[0]);
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        window.location = "update_officer_profile.php";
      } else if (text == 2) {
        window.location = "academic_officer_login.php";
      } else {
        textalert.innerHTML = text;
      }
    }
  };
  r.open("POST", "update_officer_process.php", true);
  r.send(form);
}

function addstudents() {
  var fname = document.getElementById("ofname").value;
  var lname = document.getElementById("olname").value;
  var nic = document.getElementById("nic").value;
  var grade = document.getElementById("grade").value;
  var email = document.getElementById("oemail").value;
  var gender = document.getElementById("ogender").value;
  var password1 = document.getElementById("opw").value;
  var password2 = document.getElementById("orpw").value;
  var textalert = document.getElementById("oalert");

  var form = new FormData();
  form.append("fname", fname);
  form.append("lname", lname);
  form.append("gender", gender);
  form.append("email", email);
  form.append("nic", nic);
  form.append("grade", grade);
  form.append("password1", password1);
  form.append("password2", password2);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        textalert.innerHTML = "";
        alert("done");

        document.getElementById("ofname").value = "";
        document.getElementById("olname").value = "";
        document.getElementById("nic").value = "";
        document.getElementById("oemail").value = "";
        document.getElementById("opw").value = "";
        document.getElementById("orpw").value = "";
        document.getElementById("oalert").value = "";
      } else if (text == 2) {
        window.location = "academic_officer_login.php";
      } else {
        textalert.innerHTML = text;
      }
    }
  };
  r.open("POST", "add_students_process.php", true);
  r.send(form);
}

function studentfields() {
  document.getElementById("ofname").value = "";
  document.getElementById("olname").value = "";
  document.getElementById("nic").value = "";
  document.getElementById("oemail").value = "";
  document.getElementById("opw").value = "";
  document.getElementById("rpw").value = "";
}

function release_marks(x) {
  var status = 1;

  var form = new FormData();
  form.append("id", x);
  form.append("status", status);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "view_and_release_marks.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "marks_release_process.php", true);
  r.send(form);
}

function unrelease_marks(x) {
  var status = 2;

  var form = new FormData();
  form.append("id", x);
  form.append("status", status);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "view_and_release_marks.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "marks_release_process.php", true);
  r.send(form);
}
function search_result() {
  var nic = document.getElementById("nic").value;
  var load = document.getElementById("dataload");

  var form = new FormData();
  form.append("nic", nic);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      load.innerHTML = text;
    }
  };
  r.open("POST", "search_result_process.php", true);
  r.send(form);
}

function student_grade(x) {
  var grade = document.getElementById("grade" + x).value;

  var form = new FormData();
  form.append("grade", grade);
  form.append("id", x);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "manage_students.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "student_grade_update.php", true);
  r.send(form);
}

function showPassword1() {
  var np = document.getElementById("np");
  var npbtn1 = document.getElementById("npbtn1");

  if (npbtn1.innerHTML == "Show") {
    np.type = "text";
    npbtn1.innerHTML = "Hide";
  } else {
    np.type = "password";
    npbtn1.innerHTML = "Show";
  }
}
function showPassword2() {
  var rnp = document.getElementById("rnp");
  var npbtn2 = document.getElementById("npbtn2");

  if (npbtn2.innerHTML == "Show") {
    rnp.type = "text";
    npbtn2.innerHTML = "Hide";
  } else {
    rnp.type = "password";
    npbtn2.innerHTML = "Show";
  }
}

function load_email_model() {
  var m = document.getElementById("emailpopup");
  bm = new bootstrap.Modal(m);
  bm.show();
}

function send_admin_email() {
  var email = document.getElementById("email").value;
  var f = document.getElementById("forgetPasswordModal");

  var form = new FormData();
  form.append("email", email);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == 1) {
        alert("Verification code is sent to your email");
        bm.hide();
        fm = new bootstrap.Modal(f);
        fm.show();
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "check_admin_email.php", true);
  r.send(form);
}

function reset_admin_password() {
  var e = document.getElementById("email").value;
  var np = document.getElementById("np").value;
  var rnp = document.getElementById("rnp").value;
  var vc = document.getElementById("vc").value;

  var form = new FormData();
  form.append("e", e);
  form.append("np", np);
  form.append("rnp", rnp);
  form.append("vc", vc);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == 1) {
        alert("Password Reset Success");
        fm.hide();
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "admin_password_reset.php", true);
  r.send(form);
}

//

function send_teacher_email() {
  var email = document.getElementById("email").value;
  var f = document.getElementById("forgetPasswordModal");

  var form = new FormData();
  form.append("email", email);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == 1) {
        alert("Verification code is sent to your email");
        bm.hide();
        fm = new bootstrap.Modal(f);
        fm.show();
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "check_teacher_email.php", true);
  r.send(form);
}

function reset_teacher_password() {
  var e = document.getElementById("email").value;
  var np = document.getElementById("np").value;
  var rnp = document.getElementById("rnp").value;
  var vc = document.getElementById("vc").value;

  var form = new FormData();
  form.append("e", e);
  form.append("np", np);
  form.append("rnp", rnp);
  form.append("vc", vc);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == 1) {
        alert("Password Reset Success");
        fm.hide();
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "teacher_password_reset.php", true);
  r.send(form);
}

//

function send_student_email() {
  var email = document.getElementById("email").value;
  var f = document.getElementById("forgetPasswordModal");

  var form = new FormData();
  form.append("email", email);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == 1) {
        alert("Verification code is sent to your email");
        bm.hide();
        fm = new bootstrap.Modal(f);
        fm.show();
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "check_student_email.php", true);
  r.send(form);
}

function reset_student_password() {
  var e = document.getElementById("email").value;
  var np = document.getElementById("np").value;
  var rnp = document.getElementById("rnp").value;
  var vc = document.getElementById("vc").value;

  var form = new FormData();
  form.append("e", e);
  form.append("np", np);
  form.append("rnp", rnp);
  form.append("vc", vc);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == 1) {
        alert("Password Reset Success");
        fm.hide();
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "student_password_reset.php", true);
  r.send(form);
}

//

function send_officer_email() {
  var email = document.getElementById("email").value;
  var f = document.getElementById("forgetPasswordModal");

  var form = new FormData();
  form.append("email", email);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == 1) {
        alert("Verification code is sent to your email");
        bm.hide();
        fm = new bootstrap.Modal(f);
        fm.show();
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "check_officer_email.php", true);
  r.send(form);
}

function reset_officer_password() {
  var e = document.getElementById("email").value;
  var np = document.getElementById("np").value;
  var rnp = document.getElementById("rnp").value;
  var vc = document.getElementById("vc").value;

  var form = new FormData();
  form.append("e", e);
  form.append("np", np);
  form.append("rnp", rnp);
  form.append("vc", vc);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;
      if (text == 1) {
        alert("Password Reset Success");
        fm.hide();
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "officer_password_reset.php", true);
  r.send(form);
}

function add_grade() {
  var grade = document.getElementById("grade").value;

  var form = new FormData();
  form.append("grade", grade);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "add_grade_and_subject.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "add_new_grade.php", true);
  r.send(form);
}

function add_subject() {
  var subject = document.getElementById("subject").value;

  var form = new FormData();
  form.append("subject", subject);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var text = r.responseText;

      if (text == 1) {
        alert("Success");
        window.location = "add_grade_and_subject.php";
      } else {
        alert(text);
      }
    }
  };
  r.open("POST", "add_new_subject.php", true);
  r.send(form);
}
