import 'package:flutter/material.dart';
import 'package:sipit_app/pages/history.dart';
import 'package:sipit_app/pages/homePage.dart';
import 'package:sipit_app/pages/profile.dart';
import 'package:sipit_app/pages/schedule.dart';

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
