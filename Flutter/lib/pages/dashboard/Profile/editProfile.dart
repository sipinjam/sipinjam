import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class EditProfilePage extends StatefulWidget {
  final int userId; // ID user diterima dari halaman sebelumnya
  const EditProfilePage({super.key, required this.userId});

  @override
  _EditProfilePageState createState() => _EditProfilePageState();
}

class _EditProfilePageState extends State<EditProfilePage> {
  final _formKey = GlobalKey<FormState>();
  final TextEditingController _nameController = TextEditingController();
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _phoneController = TextEditingController();

  final String apiUrl = "http://192.168.1.4:8000/api/routes/users.php/?id=";

  @override
  void initState() {
    super.initState();
    _fetchUserData(); // Ambil data user saat halaman dimuat
  }

  // Fungsi untuk fetch data user
  Future<void> _fetchUserData() async {
    try {
      final response = await http.get(Uri.parse('$apiUrl${widget.userId}'));
      if (response.statusCode == 200) {
        final data = json.decode(response.body);
        if (data['status'] == 'success') {
          final userData = data['data'];
          setState(() {
            _nameController.text =
                userData?['nama_lengkap'] ?? 'Nama tidak ditemukan';
            _emailController.text =
                userData?['email'] ?? 'Email tidak ditemukan';
            _phoneController.text =
                userData?['no_telpon'] ?? 'Nomor telepon tidak ditemukan';
          });
        } else {
          _showError("Failed to fetch user data: ${data['message']}");
        }
      } else {
        _showError("Server error: ${response.statusCode}");
      }
    } catch (e) {
      _showError("Error fetching user data: $e");
    }
  }

  // Fungsi untuk update data user
  Future<void> _updateUserProfile() async {
    if (_formKey.currentState!.validate()) {
      try {
        final updatedUser = {
          "nama_lengkap": _nameController.text,
          "email": _emailController.text,
          "no_telpon": _phoneController.text,
        };

        // Gunakan URL yang sama dengan yang di Postman
        final response = await http.patch(
          Uri.parse(
              'http://192.168.1.4:8000/api/routes/users.php/?id=${widget.userId}'),
          headers: {
            "Content-Type": "application/json",
          },
          body: json.encode(updatedUser), // Pastikan body dalam format JSON
        );

        // Debugging untuk melihat respon dari server
        print('Response status: ${response.statusCode}');
        print('Response body: ${response.body}');

        if (response.statusCode == 200) {
          final data = json.decode(response.body);
          if (data['status'] == 'success') {
            _showSuccess("Profile updated successfully!");
            Navigator.pop(context, true); // Kembali ke halaman sebelumnya
          } else {
            _showError("Failed to update profile: ${data['message']}");
          }
        } else {
          _showError("Server error: ${response.statusCode}");
        }
      } catch (e) {
        _showError("Error updating profile: $e");
      }
    }
  }

  // Future<void> _updateUserProfile() async {
  //   if (_formKey.currentState!.validate()) {
  //     try {
  //       final updatedUser = {
  //         "nama_lengkap": _nameController.text,
  //         "email": _emailController.text,
  //         "no_telpon": _phoneController.text,
  //       };

  //       // Perbaikan URL
  //       final response = await http.patch(
  //         Uri.parse('$apiUrl${widget.userId}'),
  //         headers: {
  //           "Content-Type": "application/json",
  //         },
  //         body: json.encode(updatedUser),
  //       );

  //       if (response.statusCode == 200) {
  //         final data = json.decode(response.body);
  //         if (data['status'] == 'success') {
  //           _showSuccess("Profile updated successfully!");
  //           Navigator.pop(context, true); // Kembali ke halaman sebelumnya
  //         } else {
  //           _showError("Failed to update profile: ${data['message']}");
  //         }
  //       } else {
  //         _showError("Server error: ${response.statusCode}");
  //       }
  //     } catch (e) {
  //       _showError("Error updating profile: $e");
  //     }
  //   }
  // }

//         final response = await http.patch(
//   Uri.parse('$apiUrl${widget.userId}'),
//   headers: {
//     "Content-Type": "application/json",
//   },
//   body: json.encode(updatedUser),
// );

//         if (response.statusCode == 200) {
//           final data = json.decode(response.body);
//           if (data['status'] == 'success') {
//             _showSuccess("Profile updated successfully!");
//             Navigator.pop(context, true); // Kembali ke halaman sebelumnya
//           } else {
//             _showError("Failed to update profile: ${data['message']}");
//           }
//         } else {
//           _showError("Server error: ${response.statusCode}");
//         }
//       } catch (e) {
//         _showError("Error updating profile: $e");
//       }
//     }
//   }

  // Fungsi untuk menampilkan pesan sukses
  void _showSuccess(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(message), backgroundColor: Colors.green),
    );
  }

  // Fungsi untuk menampilkan pesan error
  void _showError(String message) {
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(content: Text(message), backgroundColor: Colors.red),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          'Edit Profile',
          style: TextStyle(
            color: Colors.black,
            fontSize: 20,
            fontWeight: FontWeight.bold,
          ),
        ),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Form(
          key: _formKey,
          child: ListView(
            children: [
              TextFormField(
                controller: _nameController,
                decoration: const InputDecoration(labelText: 'Nama Lengkap'),
                validator: (value) =>
                    value!.isEmpty ? 'Nama tidak boleh kosong' : null,
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _emailController,
                decoration: const InputDecoration(labelText: 'Email'),
                validator: (value) =>
                    value!.isEmpty ? 'Email tidak boleh kosong' : null,
              ),
              const SizedBox(height: 16),
              TextFormField(
                controller: _phoneController,
                decoration: const InputDecoration(labelText: 'No. Telp'),
                validator: (value) =>
                    value!.isEmpty ? 'No. Telp tidak boleh kosong' : null,
              ),
              const SizedBox(height: 32),
              Row(
                mainAxisAlignment: MainAxisAlignment.end,
                children: [
                  ElevatedButton(
                    onPressed: () => Navigator.pop(context),
                    style: ElevatedButton.styleFrom(
                      foregroundColor: Colors.blue[700], // Warna teks biru
                      backgroundColor: Colors.white, // Latar belakang putih
                    ),
                    child: const Text('Batal'),
                  ),
                  const SizedBox(width: 16),
                  ElevatedButton(
                    onPressed: _updateUserProfile,
                    style: ElevatedButton.styleFrom(
                      foregroundColor: Colors.blue[700], // Warna teks biru
                      backgroundColor: Colors.white, // Latar belakang putih
                    ),
                    child: const Text('Konfirmasi'),
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }
}
