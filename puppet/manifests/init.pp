# Setup ThomasBiddle.com
class thomasbiddle_com {

  # Ensure apache2 is installed and up to date.
  package { 'apache2':
    ensure => 'latest',
  }

  # Setup the Apache Virtual Host (After testing, will set this up using the PuppetLabs apache module)
  file { '/etc/apache2/sites-available/thomasbiddle.com':
    ensure => present,
    require => Package['apache2'],
    content => template(thomasbiddle_com/apache2.erb"),
  }

}
