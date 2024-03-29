#!/bin/bash

# Check if a version number is provided as an argument
if [ $# -eq 0 ]; then
    echo "Error: Please provide a version number as an argument."
    exit 1
fi

# Get the current version from your composer.json
composerJson="./composer.json"
currentVersion=$(jq -r .version "$composerJson")

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

# Use the provided version or increment the current version
if [[ $1 =~ ^[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
    newVersion="$1"
else
    newVersion="$(incrementVersion "$currentVersion")"
fi

# Update the version in composer.json
jq ".version = \"$newVersion\"" "$composerJson" > "$composerJson.tmp" && mv "$composerJson.tmp" "$composerJson"

# Display the new version
echo "Creating a new release for $(jq -r .name "$composerJson")..."
echo "Current version: $currentVersion"
echo "New version: $newVersion"

# Create the tag
git tag "$newVersion"

# Push the tag to the remote repository
git push origin "$newVersion"

echo "Release created successfully."
