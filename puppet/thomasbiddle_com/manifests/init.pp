# Setup ThomasBiddle.com
class thomasbiddle_com {

  # Setup the Apache Virtual Host
  file { '/etc/apache2/sites-available/thomasbiddle.com':
    ensure  => present,
    content => template('thomasbiddle_com/apache2.erb'),
  }

  file { '/etc/apache2/sites-enabled/thomasbiddle.com':
    ensure  => link,
    target  => '/etc/apache2/sites-available/thomasbiddle.com',
    require => File['/etc/apache2/sites-available/thomasbiddle.com'],
  }

  file { '/srv/www/ThomasBiddle.com':
    ensure  => directory,
    owner   => www-data,
    group   => www-data,
    recurse => true,
  }

  # Bash script will git clone/git pull to deploy the project.
  file { '/srv/www/update_thomasbiddle_com.sh':
    ensure => present,
    owner  => www-data,
    group  => www-data,
    mode   => '0447',
    source => 'puppet:///modules/thomasbiddle_com/update_thomasbiddle_com.sh',
  }

  cron { 'deploy_thomasbiddle_com':
    ensure    => present,
    command   => 'bash /srv/www/update_thomasbiddle_com.sh',
    user      => www-data,
    minute    => '*/1',
    require   => File['/srv/www/update_thomasbiddle_com.sh'],
  }
}
