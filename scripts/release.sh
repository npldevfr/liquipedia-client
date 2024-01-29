#!/bin/bash

# Get the current version from your composer.json
currentVersion=$(jq -r .version composer.json)

# Function to increment the version in the format 0.0.0
incrementVersion() {
    local currentVersion=$1
    local regex="^([0-9]+)\.([0-9]+)\.([0-9]+)$"

    if [[ $currentVersion =~ $regex ]]; then
        local major="${BASH_REMATCH[1]}"
        local minor="${BASH_REMATCH[2]}"
        local patch="${BASH_REMATCH[3]}"
        local newVersion="$((major)).$((minor)).$((patch + 1))"
        echo "$newVersion"
    else
        echo "Error: Incorrect version format."
        exit 1
    fi
}

# Calculate the new version
newVersion=$(incrementVersion "$currentVersion")

# Display the new version
echo "Creating a new release for $(jq -r .name composer.json)..."
echo "Current version: $currentVersion"
echo "New version: $newVersion"

# Create the tag
git tag "v$newVersion"

# Push the tag to the remote repository
git push origin "v$newVersion"

echo "Release created successfully."
