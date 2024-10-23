import 'package:flutter/material.dart';
import 'package:sipit_app/pages/dashboard/History/history.dart';
import 'package:sipit_app/pages/dashboard/Home/homePage.dart';
import 'package:sipit_app/pages/dashboard/Profile/profile.dart';
import 'package:sipit_app/pages/dashboard/Schedule/schedule.dart';

class AppConstants {
  static List<Map> navMenu = [
    {
      'view': const HomePage(),
      'icon': Icons.home_filled,
      'label': 'Home',
    },
    {
      'view': const HistoryPage(),
      'icon': Icons.history_rounded,
      'label': 'History',
    },
    {
      'view': const SchedulePage(),
      'icon': Icons.calendar_month_outlined,
      'label': 'Schedule',
    },
    {
      'view': const ProfilePage(),
      'icon': Icons.account_circle,
      'label': 'Profile',
    },
  ];
}
